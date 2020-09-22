<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CouponCode extends Model
{
    //
    protected $fillable=['name','code','type','value','amount','min_price','used','use_start_time','use_end_time','enable'];

    protected $appends=['description'];

    const TYPE_FIXED='fixed';
    const TYPE_PERCENT='percent';

    public static $TypeMap=[
        self::TYPE_FIXED=>'固定金额',
        self::TYPE_PERCENT=>'比例'
    ];

    protected $casts=[
        'enable'=>'boolean'
    ];

    protected $dates=[
        'use_start_time',
        'use_end_time'
    ];

    public static function makeCouponCode($length=16)
    {
        do{
            $code=strtoupper(Str::random($length));
        }while(self::query()->where('code',$code)->exists());

        return $code;
    }

    public function getDescriptionAttribute()
    {
        $str='';
        if($this->min_price>0){
            $str='满'.str_replace('.00','',$this->min_price);
        }
        $value=str_replace('.00','',$this->value);
        if($this->type===self::TYPE_FIXED){
            return $str.'减'.$value;
        }else{

            return $str.'优惠'.$value.'%';
        }
    }

    public function updateCouponUsed($increase=true)
    {
        if($increase){
            return $this->where('id',$this->id)->where('used','<',$this->amount)->increment('used');
        }else{
            return $this->decrement('used');
        }
    }

//    计算折扣价格
    public function getAdjustedPrice($orderAmount)
    {
        // 固定金额
        if ($this->type === self::TYPE_FIXED) {
            // 为了保证系统健壮性，我们需要订单金额最少为 0.01 元
            return max(0.01, $orderAmount - $this->value);
        }

        return number_format($orderAmount * (100 - $this->value) / 100, 2, '.', '');
    }
}
