<?php

namespace App\Http\Controllers;

use App\Events\OrderPaid;
use App\Exceptions\InvalidRequestException;
use App\Order;
use App\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yansongda\Pay\Log;

class PaymentController extends Controller
{
//    订单本地支付
    public function pay(Order $order)
    {
//        权限验证
        $this->authorize('own',$order);
        if($order->paid_at || $order->closed){
            throw new InvalidRequestException('订单状态不正确');
        }
        $order->update([
            'paid_at'        => Carbon::now(), // 支付时间
            'payment_method' => 'wechat', // 支付方式
            'payment_no'     => date('YmdHis').str_pad(random_int(0,999999),6,0,STR_PAD_LEFT), // 支付宝订单号
        ]);
        $order->load('orderItems.product');
//        dd($order);
        foreach($order->orderItems as $item){
            $product=$item->product;
            $sold_count=OrderItem::query()->where('product_id',$product->id)->whereHas('order',function($query){
                $query->whereNotNull('paid_at');
            })->sum('amount');
            $product->update(['sold_count'=>$sold_count]);
        }
        return [];
    }
    //订单支付
    public function payByAlipay(Order $order,Request $request)
    {
//        权限验证
        $this->authorize('own',$order);
//        判断订单是否已支付
        if($order->paid_at || $order->closed){
            throw new InvalidRequestException('订单状态不正确');
        }
//        调用支付宝的网页支付
       return app('alipay')->web([
            'out_trade_no'=>$order->no,
            'total_amount'=>$order->total_amount,
            'subject'=>'小米支付订单：'.$order->no,
        ]);
    }
    // 前端回调页面
    public function alipayReturn()
    {
        try {
            app('alipay')->verify();
        } catch (\Exception $e) {
            return view('pages.error', ['msg' => '数据不正确']);
        }

        return view('pages.success', ['msg' => '付款成功']);
    }

    // 服务器端回调
    public function alipayNotify()
    {
        // 校验输入参数
        $data  = app('alipay')->verify();
        // 如果订单状态不是成功或者结束，则不走后续的逻辑
        // 所有交易状态：https://docs.open.alipay.com/59/103672
        if(!in_array($data->trade_status, ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
            return app('alipay')->success();
        }
        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
        $order = Order::where('no', $data->out_trade_no)->first();
        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if (!$order) {
            return 'fail';
        }
        // 如果这笔订单的状态已经是已支付
        if ($order->paid_at) {
            // 返回数据给支付宝
            return app('alipay')->success();
        }

        $order->update([
            'paid_at'        => Carbon::now(), // 支付时间
            'payment_method' => 'alipay', // 支付方式
            'payment_no'     => $data->trade_no, // 支付宝订单号
        ]);

//        调用支付成功事件
        $this->afterPaid($order);
        return app('alipay')->success();
    }
//    调用支付成功事件
    public function afterPaid(Order $order)
    {
        event(new OrderPaid($order));
    }
}
