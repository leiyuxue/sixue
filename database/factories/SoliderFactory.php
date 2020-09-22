<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Solider;
use Faker\Generator as Faker;

$factory->define(Solider::class, function (Faker $faker) {
    $imgs=[
        'images/solid1.jpg',
        'images/solid2.jpg',
        'images/solid3.jpg',
        'images/solid4.jpg',
        'images/solid5.jpg',

    ];
    return [
       'title'=>$faker->word,
        'img'=>$faker->randomElement($imgs),
        'link'=>'http://www.baidu.com',
        'enable'=>1
    ];
});
