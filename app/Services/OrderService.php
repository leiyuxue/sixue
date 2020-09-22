<?php


namespace App\Services;


use App\CartItem;
use App\CouponCode;
use App\Exceptions\InvalidRequestException;
use App\Jobs\CloseOrder;
use App\Order;
use App\ProductSku;
use App\User;
use App\UserAddress;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function add(User $user,UserAddress $userAddress,$cartItems,$couponId)
    {
        return DB::transaction(function() use($user,$userAddress,$cartItems,$couponId){
            $order=new Order([
                'address'=>[
                    'address'=>$userAddress->full_address,
                    'contact_name'=>$userAddress->contact_name,
                    'contact_phone'=>$userAddress->contact_phone,
                ],
                'remark'=>'无备注',
                'total_amount'=>0,
                'refund_status'=>Order::REFUND_STATUS_PENDING,
                'ship_status'=>Order::SHIP_STATUS_PENDING,
            ]);
            $order->user()->associate($user);
            if($couponId){
//                如果在购买的过程中后台优惠卷关闭，就不能使用了
                if(!$coupon_code=CouponCode::where('enable',true)->find($couponId)){
                    throw new InvalidRequestException('优惠卷不存在');
                }
//                判断用户是否已经使用过了，优惠卷用户只能使用一次
                $is_used=Order::where('user_id',$order->user_id)->where('coupon_code_id',$couponId)->where(function($query){
                    $query->where(function($query){
                        $query->whereNull('paid_at')->where('closed',0);
                    })->orWhere(function($query){
                        $query->whereNotNull('paid_at')->where('refund_status','!=',Order::REFUND_STATUS_SUCCESS);
                    });

                })->exists();
                if($is_used){
                    throw new InvalidRequestException('您已经使用过了该优惠卷');
                }
                $order->couponCode()->associate($coupon_code);
                if($coupon_code->updateCouponUsed()<0){
                    throw new InvalidRequestException('优惠卷已兑完');
                }
            }
            $order->save();
//            总价
            $totalAmount=0;
            foreach($cartItems as $cart_item){
                $productSku=ProductSku::find($cart_item['product_sku_id']);
                $order_item=$order->orderItems()->make([
                    'price'=>$productSku->price,
                    'amount'=>$cart_item['amount'],
                ]);
                $order_item->product()->associate($productSku->product_id);
                $order_item->productSku()->associate($productSku['id']);
                $order_item->save();
                $totalAmount+=$cart_item['amount']*$productSku->price;
                if($productSku->decreaseStock($cart_item['amount'])<=0){
                    throw new InvalidRequestException('商品库存不足');
                }
            }
            dispatch(new CloseOrder($order,config('app.close_order_ttl')));

            // 更新订单总金额
            $order->update(['total_amount' => $totalAmount]);

            return $order;
        });
    }
}
