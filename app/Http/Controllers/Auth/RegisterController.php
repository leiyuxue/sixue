<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerificationCodeRequest;
use App\Http\Requests\SendPhoneCodeRequest;
use App\Http\Requests\ValidatePhoneCodeRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password'=>['required','between:8,20','alpha_dash'],
            'repassword'=>['required','same:password'],
        ],[
            'password.required'=>'请输入密码',
            'password.between'=>'密码长度在8-20为之间',
            'password.alpha_dash'=>'密码格式由字母、数字、破折号（ - ）以及下划线（ _ ）组成',
            'repassword.required'=>'请二次填写密码',
            'repassword.same'=>'两次密码不一致',
        ]);
    }
//    发送手机验证码
    public function sendPhoneCode(SendPhoneCodeRequest $request,EasySms $easySms)
    {
        $phone = $request->phone;
        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

            try {
                $result = $easySms->send($phone, [
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                abort(500, $message ?: '短信发送异常');
            }
        }
        $key = 'verificationCode_'.Str::random(15);
        $expiredAt = now()->addMinutes(5);
        // 缓存验证码 5 分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        return response()->json([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
//    判断手机验证码是否正确
    public function validatePhoneCode(ValidatePhoneCodeRequest $request)
    {
        $phoneCodeKey=$request->phoneCodeKey;
        $phoneCode=$request->phoneCode;
//        缓存读取数据
        if($cacheData=Cache::get($phoneCodeKey)){
            if(!hash_equals($phoneCode,$cacheData['code'])){
                return response()->json(['errmsg'=>'验证码错误'])->setStatusCode(401);
            }else{
                Cache::forget($phoneCodeKey);
                return response()->json(['success'=>'ok'])->setStatusCode(200);
            }
        }else{
            return response()->json(['errmsg'=>'未发送验证码，或者验证码以过期'])->setStatusCode(403);
        }

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
              'phone'=>$data['phone'],
              'password'=>Hash::make($data['password'])
        ]);
    }
}
