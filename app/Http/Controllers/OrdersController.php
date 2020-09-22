<?php

namespace App\Http\Controllers;

use App\Events\OrderReviewed;
use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\OrderRequest;
use App\Jobs\CloseOrder;
use App\Order;
use App\OrderItem;
use App\ProductSku;
use App\Services\OrderService;
use App\User;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService=$orderService;
    }

    //下订单
    public function store(OrderRequest $request)
    {
        $user=$request->user();
        $userAddress=UserAddress::find($request->input('address_id'));
        $cart_items=$request->input('cart_items');
        $couponId=$request->couponId;
        return $this->orderService->add($user,$userAddress,$cart_items,$couponId);

    }
//    确认购买页面
    public function buyConfirm(Request $request)
    {
//        获取订单编号
        $id=$request->input('id');
//        查询订单
        if(!$order=Order::with(['orderItems.productSku.product','couponCode'])->find($id)){
            throw new InternalException('订单不存在');
        };
//        权限验证
        $this->authorize('own',$order);
        return view('orders.buy_confirm',compact('order'));

    }
//    申请退款
    public function refund(Order $order)
    {

    }
//    评价页面
    public function review_create(Order $order)
    {

        $this->authorize('own',$order);
        $order=Order::with(['orderItems.productSku.product','orderItems.OrderItemReviewImg'])->find($order->id);
        return view('orders.review_create',compact('order'));
    }
//    评论
    public function review_store(Order $order,Request $request)
    {
        $this->authorize('own',$order);
        $reviews=$request->reviews;
//        判断是否评价
        if($order->reviewed){
            throw new InvalidRequestException('该订单已经评价');
        }
        if(!$order->paid_at){
            throw new InvalidRequestException('该订单未支付');
        }
        if($order->ship_status!==Order::SHIP_STATUS_RECEIVED){
            throw new InvalidRequestException('订单状态不正确');
        }
        DB::transaction(function() use($order,$reviews){
            foreach ($reviews as $review){
                $orderItem=$order->orderItems()->find($review['id']);
                $orderItem->update([
                    'rating'=>$review['rating'],
                    'review'=>$review['review'],
                    'review_at'=>Carbon::now(),
                ]);

            }
            $order->update([
                'reviewed'=>true,
            ]);
//            上线后使用
//            event(new OrderReviewed($order));


//            本地事件，统计评论总数和平均评分
//            查询订单下的item
            $orderItems=$order->orderItems()->with(['product'])->get();
            foreach($orderItems as $orderItem){
//                查询orderItem表对应的商品id和评价的item商品id相同的所有数据
                $result=OrderItem::query()->where('product_id',$orderItem->product_id)->whereNotNull('review_at')->whereHas('order',function($query){
                   $query->whereNotNull('paid_at');
                })->first([
                    DB::raw('count(*) as review_count'),
                    DB::raw('avg(rating) as rating')
                ]);
//                更新商品表平均分和评价总数
                $orderItem->product->update([
                    'rating'=>$result->rating,
                    'review_count'=>$result->review_count
                ]);
            }
        });
    }
//    确认收货
    public function confirmReceived(Order $order)
    {
        $this->authorize('own',$order);
        if(!$order->paid_at){
            throw new InvalidRequestException('订单未付款');
        }
        if($order->closed){
            throw new InvalidRequestException('订单已关闭');
        }
        if($order->ship_status!==Order::SHIP_STATUS_DELIVERED){
            throw new InvalidRequestException('发货状态不正确');
        }
        $order->update(['ship_status'=>Order::SHIP_STATUS_RECEIVED]);
        return [];
    }
}
