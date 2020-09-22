<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CloseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order,$delay)
    {
        $this->order=$order;
        $this->delay($delay);
    }

    /**
     * Execute the job.
     * 当调用这个任务类时，会执行下面的handle方法
     * @return void
     */
    public function handle()
    {
        //判断订单是否已经支付，如果支付直接返回，终止关闭操作
        if($this->order->paid_at){
            return;
        }
//        执行关闭操作
        DB::transaction(function(){
            $this->order->update(['closed'=>true]);
//            循环orderItems把单品数量加回去
            foreach($this->order->orderItems as $orderItem){
                $orderItem->productSku->addStock($orderItem->amount);
            }
        });
    }
}
