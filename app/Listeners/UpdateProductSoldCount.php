<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\OrderItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductSoldCount implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $order=$event->getOrder();
        $order->load('orderItems.product');
        foreach ($order->order_items as $item){
            $product=$item->product;
            $sold_count=OrderItem::query()->where('product_id',$product->id)->whereHas('order',function($query){
                $query->whereNotNull('paid_at');
            })->sum('amount');
            $product->update(['sold_count'=>$sold_count]);
        }
    }
}
