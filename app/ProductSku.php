<?php

namespace App;

use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductSku extends Model
{
    protected $fillable=['title','description','price','stock','imgs'];



//    protected $casts=[
//        'imgs'=>'json'
//    ];

    protected $appends=['imgs_url'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getPropsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function getImgsUrlAttribute()
    {
        if(\Illuminate\Support\Str::startsWith($this->attributes['imgs'],['http://','https://'])){
            return $this->attributes['imgs'];
        }
        return Storage::disk('public')->url($this->attributes['imgs']);
    }


    public function setPropsAttribute($value)
    {
        $this->attributes['props'] = json_encode(array_values($value));
    }
    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('减库存不可小于0');
        }

        return $this->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }

    public function productSkuProps()
    {
        return $this->hasMany(ProductSkuProp::class);
    }
}
