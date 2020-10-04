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
//    登录用的
    Route::middleware('throttle:'.config('api.rate_limits.sign'))->group(function(){
//      图片验证码
        Route::post('captchas','CaptchasController@store')->name('captchas.store');
//      短信验证码
        Route::post('verificationCodes', 'VerificationCodesController@store')
            ->name('verificationCodes.store');
//      用户注册
        Route::post('users','UsersController@store')->name('users.store');
//      微信登录
        Route::post('socials/{social_type}/authorizations','AuthorizationsController@socialStore')
            ->where('social_type','wechat')
            ->name('socials.authorizations.socialStore');
//      登录
        Route::post('authorizations','AuthorizationsController@store')->name('api.authorizations.store');
        // 刷新token
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('authorizations.update');
        // 删除token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('authorizations.destroy');
    });
//    其他用的
    Route::middleware('throttle:'.config('api.rate_limits.access'))->group(function(){
//        游客
//        某个用户详情
          Route::get('users/{user}','UsersController@show')->name('users.show');
//        登录可访问
          Route::middleware('auth:api')->group(function(){
//              登录用户的用户信息
              Route::get('user','UsersController@me')->name('user.show');
//              上传图片
              Route::post('images','ImagesController@store')->name('images.store');
//              编辑登录用户信息
              Route::patch('user','UsersController@update')->name('user.update');
          });
    });

});
Route::prefix('v2')->name('api.v2.')->group(function(){
    Route::get('version',function(){
        return 'this is version v2';
    });
});
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
