<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class Product extends Model
{
    protected $fillable=['type','title','description','price','on_sale','image','rating','review_count','sold_count','summaries','long_title','flash_img'];
    protected $appends=['img_url','summary_url','grouped_properties','flash_img_url'];

    const TYPE_NORMAL='normal';
    const TYPE_SECKILL='seckill';

    protected $casts=[
        'on_sale'=>'boolean'
    ];
    public static $typeMap=[
        self::TYPE_NORMAL=>'普通商品',
        self::TYPE_SECKILL=>'秒杀商品',
    ];


    public function toESArray()
    {
        // 只取出需要的字段
        $arr = Arr::only($this->toArray(), [
            'id',
            'type',
            'title',
            'category_id',
            'long_title',
            'on_sale',
            'rating',
            'sold_count',
            'review_count',
            'price',
        ]);

        // 如果商品有类目，则 category 字段为类目名数组，否则为空字符串
        $arr['category'] = $this->category ? explode(' - ', $this->category->parent_full_name) : '';
        // 类目的 path 字段
        $arr['category_path'] = $this->category ? $this->category->path : '';
        // strip_tags 函数可以将 html 标签去除
        $arr['description'] = strip_tags($this->description);
        // 只取出需要的 SKU 字段
        $arr['skus'] = $this->skus->map(function (ProductSku $sku) {
            return Arr::only($sku->toArray(), ['title', 'description', 'price']);
        });
        // 只取出需要的商品属性字段
        $arr['propties'] = $this->propties->map(function (ProductPropty $property) {
            return Arr::only($property->toArray(), ['name', 'value']);
        });

        return $arr;
    }

    public function scopeByIds($query,$ids)
    {
        return $query->whereIn('id',$ids)->orderByRaw(sprintf("FIND_IN_SET(id,'%s')",join(',',$ids)));
    }
//    关联skus
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }
//    关联商品非销售属性
    public function propties()
    {
        return $this->hasMany(ProductPropty::class);
    }
    public function getGroupedPropertiesAttribute()
    {
        return $this->propties
            // 按照属性名聚合，返回的集合的 key 是属性名，value 是包含该属性名的所有属性集合
            ->groupBy('name')
            ->map(function ($propty) {
                // 使用 map 方法将属性集合变为属性值集合
                return $propty->pluck('value')->all();
            });
    }
    public function getImgUrlAttribute()
    {
        if(\Illuminate\Support\Str::startsWith($this->attributes['img'],['http://','https://'])){
            return $this->attributes['img'];
        }
        return Storage::disk('public')->url($this->attributes['img']);
    }

    public function getFlashImgUrlAttribute()
    {
        if(\Illuminate\Support\Str::startsWith($this->attributes['flash_img'],['http://','https://'])){
            return $this->attributes['flash_img'];
        }
        return Storage::disk('public')->url($this->attributes['flash_img']);
    }

    public function getSummaryUrlAttribute()
    {
        if($this->attributes['summaries']){
            $summaries=explode(',',$this->attributes['summaries']);
            $sum_arr=[];
            foreach($summaries as $s){
                array_push($sum_arr,Storage::disk('public')->url($s));
            }
            return $sum_arr;
        }else{
            return [];
        }

    }
    public function setSummariesAttribute($value)
    {
        if(is_array($value)){
            $this->attributes['summaries']=implode(',',array_values($value));
        }else{
            $this->attributes['summaries']=null;
        }
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seckill_time()
    {
        return $this->belongsTo(SeckillTime::class);
    }
}
