<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OrderItem extends Model
{
    protected $fillable=['review','rating','amount','price','review_at'];

    public $timestamps=false;



    protected $appends=['rating_tip'];
//    关联商品
    public function product()
    {
        return $this->belongsTo(Product::class);

    }
//    关联单品
    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }
//    关联订单
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
//    关联评论图片
    public function OrderItemReviewImg()
    {
        return $this->hasMany(OrderItemReviewImg::class);
    }

    public function getRatingTipAttribute()
    {
        if($this->rating===1){
            return ['icon'=>'fa fa-frown-o','text'=>'极差'];
        }
        if($this->rating===2){
            return ['icon'=>'fa fa-frown-o','text'=>'失望'];
        }
        if($this->rating===3){
            return ['icon'=>'fa fa-meh-o','text'=>'一般'];
        }
        if($this->rating===4){
            return ['icon'=>'fa fa-meh-o','text'=>'满意'];
        }
        if($this->rating===5){
            return ['icon'=>'fa fa-smile-o','text'=>'惊喜'];
        }
    }
}
