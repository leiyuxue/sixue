<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeckillTime extends Model
{
    protected $fillable=['start_at','end_at'];

    public $timestamps=false;
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
