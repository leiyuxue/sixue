<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//测试路由
Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function () {
    Route::middleware('throttle:'.config('api.rate_limits.sign'))->group(function(){
//        图片验证码
        Route::post('captchas','CaptchasController@store')->name('captchas.store');
        // 短信验证码
        Route::post('verificationCodes', 'VerificationCodesController@store')
            ->name('verificationCodes.store');
//    用户注册
        Route::post('users','UsersController@store')->name('users.store');
//        微信登录
        Route::post('socials/{social_type}/authorizations','AuthorizationsController@socialStore')
            ->where('social_type','wechat')
            ->name('socials.authorizations.socialStore');
    });
    Route::middleware('throttle'.config('api.rate_limits.access'))->group(function(){

    });

});
Route::prefix('v2')->name('api.v2.')->group(function(){
    Route::get('version',function(){
        return 'this is version v2';
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
