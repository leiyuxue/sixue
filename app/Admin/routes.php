<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'), // 'admin'
    'namespace'     => config('admin.route.namespace'), //'App\\Admin\\Controllers',
    'middleware'    => config('admin.route.middleware'),// ['web,'admin']
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/users','UsersController@index')->name('admin.users');
//    商品管理
    $router->get('/products','ProductsController@index')->name('admin.products');
//    添加商品
    $router->get('/products/create','ProductsController@create')->name('admin.products.create');
    $router->post('/products','ProductsController@store')->name('admin.products.store');
//    编辑商品
    $router->get('/products/{id}/edit','ProductsController@edit')->name('admin.products.edit');
    $router->put('/products/{id}','ProductsController@update')->name('admin.products.update');

//    秒杀时间段设置
    $router->resource('/seckill_times','SeckillTimesController');

//    秒杀列表
    $router->get('/api/seckill_times','SeckillTimesController@apiSeckillTime');

//    秒杀商品
    $router->resource('seckill_products','SeckillProductsController');
//    添加商品概述
    $router->get('/productSummaries/{id}/edit','ProductsController@summaryEdit');
    $router->put('/productSummaries/{id}','ProductsController@summaryUpdate');
//    订单列表
    $router->get('/orders','OrdersController@index')->name('admin.orders.index');
//    订单详情
    $router->get('/orders/{order}','OrdersController@show')->name('admin.orders.show');
//    发货
    $router->post('/orders/{order}/ship','OrdersController@ship')->name('admin.orders.ship');
//    优惠卷
    $router->get('/coupon_codes','CouponCodesController@index');

    $router->post('coupon_codes', 'CouponCodesController@store');
    $router->get('coupon_codes/create', 'CouponCodesController@create');
    $router->get('coupon_codes/{id}/edit', 'CouponCodesController@edit');
    $router->put('coupon_codes/{id}', 'CouponCodesController@update');
    $router->delete('coupon_codes/{id}', 'CouponCodesController@destroy');
//    商品类目
    $router->resource('categories','CategoriesController');
//    $router->get('categories','CategoriesController@index');
//    搜索商品类目
    $router->get('/api/categories/','CategoriesController@apiSearchCategory');
//    幻灯片
    $router->resource('soliders','SolidersController');
});
