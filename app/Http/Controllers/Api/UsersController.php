<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Image;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    //用户注册
    public function store(UserRequest $request)
    {
        $verifyData=Cache::get($request->verification_key);
        if(!$verifyData){
            abort(403,'验证码已失效');
        }
        if(!hash_equals($verifyData['code'],$request->verification_code)){
            throw new AuthenticationException('验证码错误');
        }
        $user=User::create([
            'name'=>$request->name,
            'phone'=>$verifyData['phone'],
            'password'=>$request->password,

        ]);
//        清楚缓存
        Cache::forget($request->verification_key);
        return (new UserResource($user))->showSensitiveFields();
    }
//    获取用户信息
    public function show(Request $request,User $user)
    {
        return new UserResource($user);
    }
//    获取登录用户信息
    public function me(Request $request)
    {
        return (new UserResource($request->user()))->showSensitiveFields();
    }
//    更新用户信息
    public function update(UserRequest $request)
    {
        $user=$request->user();
        $data=$request->only([
            'name','introduction','email'
        ]);
        if($request->avatar_image_id){
            $image=Image::find($request->avatar_image_id);
            $data['avatar']=$image->path;
        }
        $user->update($data);
        return (new UserResource($user))->showSensitiveFields();
    }
}
