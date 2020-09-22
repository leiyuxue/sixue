<?php

namespace App\Listeners;

use App\Events\OrderReviewed;
use App\OrderItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UpdateProductRating implements ShouldQueue
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
     * @param  OrderReviewed  $event
     * @return void
     */
    public function handle(OrderReviewed $event)
    {
        $orderItems=$event->getOrder()->orderItems()->with(['product'])->get();
        foreach($orderItems as $orderItem){
//                查询orderItem表对应的商品id和评价的item商品id相同的所有数据
            $result=OrderItem::query()->where('product_id',$orderItem->product_id)->whereNotNull('reviewed_at')->whereHas('order',function($query){
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
    }
}
