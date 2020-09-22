<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

//    随机去一个用户
    $user=\App\User::query()->inRandomOrder()->first();
//    随机取该用户的一个收货地址
    $address=$user->addresses()->inRandomOrder()->first();
//    百分之十退款
    $refund=random_int(1,10)<1;
//    物流状态
    $ship=$faker->randomElement(array_keys(Order::$shipStatusMap));
//    优惠卷
    $coupon_code=null;
    if(random_int(0,10)<3){
        $coupon_code=\App\CouponCode::where('min_price',0)->inRandomOrder()->first();
        if($coupon_code){
            $coupon_code->updateCouponUsed();
        }

    }
    return [
        'user_id'=>$user->id,
        'address'=>[
            'address'=>$address->full_address,
            'contact_phone'=>$address->phone,
            'contact_name'=>$address->address,
        ],
        'total_amount'=>0,
        'remark'=>$faker->realText(50),
        'paid_at'=>$faker->dateTimeBetween('-30 days'),
        'coupon_code_id'=>$coupon_code?$coupon_code['id']:null,
        'payment_method'=>$faker->randomElement(['alipay','wechat']),
        'payment_no'=>$faker->uuid,
        'refund_status'=>$refund?Order::REFUND_STATUS_SUCCESS:Order::REFUND_STATUS_PENDING,
        'refund_no'=>Order::makeRefundNo(),
        'closed'=>false,
        'reviewed'=>random_int(0,10)>2,
        'ship_status'=>$ship,
        'ship_data'=>$ship===Order::SHIP_STATUS_PENDING?null:[
            'express_company'=>$faker->company,
            'express_no'=>$faker->uuid,
        ],
        'extra'=>$refund?['refund_reason'=>$faker->sentence]:[],
    ];
});
