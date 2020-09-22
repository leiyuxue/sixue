<?php
namespace App\Http\ViewComposers;
use App\Category;
use App\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HeaderViewComposer{
    public function compose(View $view){
        //        查询分类下的商品
        $categories=Category::query()->where('is_directory',1)->get();
        foreach($categories as $category){
            $cids=Category::query()->where('path','like','%-'.$category->id.'-%')->where('is_directory',0)->pluck('id');
            $category['products']=Product::query()->whereIn('category_id',$cids)->where('on_sale',1)->get();
        }
//        是否登录
        $is_login=Auth::check();
//        登录用户信息
        $user=Auth::user();
//        购物车数据
        if($is_login){
            $carts=$user->cartItems()->with(['productSku.product'])->get();
        }else{
            $carts="{}";
        }

//        dd($carts);
//        dd($categories);
        $view->with([
            'categories'=>$categories,
            'route_class'=>route_class(),
            'is_login'=>$is_login,
            'user'=>$user,
            'carts'=>$carts,
        ]);
    }
}
