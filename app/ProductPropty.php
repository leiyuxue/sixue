<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPropty extends Model
{
    protected $fillable=['name','value'];

//    没有时间
    public $timestamps=false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
