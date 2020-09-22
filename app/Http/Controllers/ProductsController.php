<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exceptions\InvalidRequestException;
use App\OrderItem;
use App\Product;
use App\SearchBuilders\ProductSearchBuilder;
use App\SeckillTime;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends BaseController
{
    //秒杀
    public function seckill()
    {
        $seckills=SeckillTime::query()->with(['products'=>function($query){
            $query->where('on_sale',1)->where('type',Product::TYPE_SECKILL);
        }])->orderBy('start_at')->get();
        $is_login=Auth::check();
        return view('products.seckill',['seckills'=>$seckills,'is_login'=>$is_login]);
    }
//    商品详情页
    public function show(Product $product,Request $request,ProductService $service)
    {
        if(!$product->id){
            throw new InvalidRequestException('该商品不存在');
        }
        if(!$product->on_sale){
            throw new InvalidRequestException('该商品未上架');
        }
//        相似商品
        $similarProductIds=$service->getSimilarProductIds($product,4);
        $similarProducts=Product::query()
            ->byIds($similarProductIds)
            ->get();
        $favored=false;
        if($user=$request->user()){
            $favored=boolval($user->favoriteProducts()->find($product['id']));
        }
        $is_login=Auth::check();
//        dd($favored);
        return view('products.show',[
            'product'=>$product->load(['category','skus','propties','seckill_time']),
            'favored'=>$favored,
            'user'=>$user,
            'is_login'=>$is_login,
            'similarProducts'=>$similarProducts
        ]);
    }
//    商品评价页面
    public function comment(Product $product,Request $request)
    {
        $commentsData= $product->OrderItems()->whereHas('order',function($query){
            $query->where('reviewed',1);
        })->with(['order.user','productSku','product','OrderItemReviewImg'])->get();
        return view('products.comment',['commentsData'=>$commentsData,'product'=>$product->load(['category','skus','propties']),'user'=>$request->user()]);
    }
//    商品概述
    public function summaries(Product $product)
    {
        return view('products.summaries',['product'=>$product->load(['category','skus','propties'])]);
    }
//    商品非销售属性
    public function propties(Product $product)
    {
        return view('products.propties',['product'=>$product->load(['category','skus','propties'])]);
    }
//    收藏商品
    public function favor(Product $product,Request $request)
    {
        $user=$request->user();
        if($user->favoriteProducts()->find($product)){
            return [];
        }
        $user->favoriteProducts()->attach($product);
        return [];
    }
//    取消收藏
    public function disfavor(Product $product,Request $request)
    {
        $user=$request->user();
        $user->favoriteProducts()->detach($product);
        return [];
    }
}
