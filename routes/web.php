<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@root')->name('root');
//异常 错误页面
//Route::get();
Auth::routes();

//发送手机验证码
Route::post('/sendPhoneCode','Auth\RegisterController@sendPhoneCode')->name('auth.sendPhoneCode');
//验证手机验证码
Route::post('/validatePhoneCode','Auth\RegisterController@validatePhoneCode')->name('auth.validatePhoneCode');
//用户资源路由
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
//账号信息
Route::get('users/account/{type}','UsersController@account')->name('users.account');
//秒杀
Route::get('seckill','ProductsController@seckill')->name('products.seckill');
//商品详情页
Route::get('products/{product}','ProductsController@show')->name('products.show');
//商品评价
Route::get('comment/{product}','ProductsController@comment')->name('products.comment');
//商品概述
Route::get('products/summaries/{product}','ProductsController@summaries')->name('products.summaries');
//商品非销售属性
Route::get('products/propties/{product}','ProductsController@propties')->name('products.propties');
//需要登录的路由
Route::group(['middleware'=>['auth']],function(){
//    个人中心
    Route::get('/user/{user}/account','UsersController@account');
    //个人中心
    Route::get('/users/{user}/personal/{type}','UsersController@personal')->name('users.personal');
//    添加收货地址
    Route::post('/user_address','UserAddressesController@store')->name('user_address.store');
//    修改收货地址
    Route::put('/user_address/{user_address}','UserAddressesController@update')->name('user_address.update');
//    删除收货地址
    Route::delete('/user_address/{user_address}','UserAddressesController@destroy')->name('user_address.destroy');
//    商品收藏
    Route::post('products/{product}/favor','ProductsController@favor')->name('products.favor');
//    商品取消收藏
    Route::delete('products/{product}/favor','ProductsController@disfavor')->name('products.disfavor');
//    加入购物车
    Route::post('addCart','CartController@store')->name('cart.add');
//    加入购物车成功，跳转页面
    Route::get('addCartSuccess/{cart_item}','CartController@addCartSuccess');
//    购物车列表
    Route::get('cart_list','CartController@cartList')->name('cart_list');
//    删除购物车商品
    Route::delete('del/{cart}','CartController@del')->name('cart.del');
//    更新购物车商品数量
    Route::put('update_amount/{cart}','CartController@update_amount')->name('cart.update_num');
//    修改购物车属性
    Route::post('update_attr/{cart}','CartController@update_attr')->name('cart.update_attr');
//    选出购物车要购买的商品
    Route::get('/cart/checkout','CartController@checkout')->name('cart.checkout');
//    下订单
    Route::post('orders','OrdersController@store')->name('orders.store');
//    确认支付页面
    Route::get('/buy/confirm','OrdersController@buyConfirm')->name('buy.confirm');

//    本地支付
    Route::post('/pay/{order}','PaymentController@pay');

//    支付宝支付
    Route::get('/payment/{order}/alipay','PaymentController@payByAlipay')->name('payment.alipay');
//    支付宝前端回掉
    Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');
//    申请退款
    Route::post('orders/{order}/refund','OrdersController@refund')->name('orders.refund');
//    提交评论
    Route::post('orders/{order}/review','OrdersController@review_store')->name('orders.review_store');
//    确认收货
    Route::post('orders/{order}/confirmReceived','OrdersController@confirmReceived')->name('orders.confirmReceived');
//    订单评价页面
    Route::get('orders/{order}/review','OrdersController@review_create')->name('orders.review_create');
});
//搜索页面
Route::get('search','PagesController@search')->name('search');
//分类下的所有商品列表
Route::get('/a/c/{category}','CategoriesController@category_products');
Route::get('/home', 'HomeController@index')->name('home');
//图片上传
Route::post('/abc','PagesController@abc');
//支付宝支付后端回掉
Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');
//lxmjhw4640@sandbox.com
