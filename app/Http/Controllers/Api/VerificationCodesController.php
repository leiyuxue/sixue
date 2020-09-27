<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request,EasySms $easySms)
    {

        $captchaData=Cache::get($request->captcha_key);
//        return $captchaData;
        if(!$captchaData){
            abort(403,'图片验证码已失效');
        }
        if (!hash_equals(strtolower($captchaData['captcha_code']), strtolower($request->captcha_code))) {
            // 验证错误就清除缓存
            Cache::forget($request->captcha_key);
            throw new AuthenticationException('验证码错误');
        }
        $phone=$captchaData['phone'];
        if (!app()->environment('production')) {
            $code = '1234';
        }else{
            //        生成随机4为随机数，左侧补0
            $code=str_pad(random_int(1,9999),4,0,STR_PAD_LEFT);
            try{
                $result=$easySms->send($phone,[
                    'template'=>config('easysms.gateways.aliyun.templates.register'),
                    'data'=>[
                        'code'=>$code
                    ],
                ]);
            }catch (NoGatewayAvailableException $exception){
                $message=$exception->getException('aliyun')->getMessage();
                abort(500,$message?:'短信发送异常');
            }
        }

        $key='verificationCode_'.Str::random(15);
        $expiredAt=now()->addMinutes();//这里的时间是Carbon对象时间， date: 2020-09-24 12:59:54.347519 Asia/Shanghai (+08:00)
        //$expiredAt->toDataTimeString() 返回的是时间字符串  2020-09-24 13:07:20
        Cache::put($key,['phone'=>$phone,'code'=>$code],$expiredAt);
        return response()->json(['key' => $key,'expired_at'=>$expiredAt->toDateTimeString()])->setStatusCode(201);
    }
}
