<?php



use App\CouponCode;
use Faker\Generator as Faker;

$factory->define(CouponCode::class, function (Faker $faker) {
    $type=$faker->randomElement(array_keys(CouponCode::$TypeMap));
    $value=$type===CouponCode::TYPE_FIXED?random_int(1,200):random_int(1,50);
    $min_price=$type===CouponCode::TYPE_FIXED?$value:random_int(100,1000)||0;
    return [
        'name'=>join(' ',$faker->words),
        'code'=>CouponCode::makeCouponCode(),
        'type'=>$type,
        'value'=>$value,
        'amount'=>500,
        'used'=>0,
        'min_price'=>$min_price,
        'use_start_time'=>null,
        'use_end_time'=>null,
        'enable'=>0,
    ];
});
