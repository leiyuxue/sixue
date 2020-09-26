<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CaptchasController extends Controller
{
    //获取图片验证码
    public function store(CaptchaRequest $request,CaptchaBuilder $builder)
    {
        $captcha_key='captcha-'.Str::random(15);
        $phone=$request->phone;
        $captcha=$builder->build();
        $expiredAt=now()->addMinutes(2);
//        写入缓存
        Cache::put($captcha_key,['phone'=>$phone,'captcha_code'=>$captcha->getPhrase()],$expiredAt);
        $result=[
            'captcha_key'=>$captcha_key,
            'expired_at'=>$expiredAt->toDateTimeString(),
            'captcha_image_content'=>$captcha->inline(),
        ];
        return response()->json($result)->setStatusCode(201);
    }
}
