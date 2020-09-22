<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItemReviewImg extends Model
{
    protected $fillable=['order_item_id','url'];

    public function OrderItem()
    {
        return $this->belongsTo(OrderItem::class);
   }
}
