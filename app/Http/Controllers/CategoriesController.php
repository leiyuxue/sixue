<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //分类下的所有商品
    public function category_products(Category $category)
    {
        if($category->is_directory){
            $categories=$category->children()->with(['products'])->get();
            $ids=Category::query()->where('path','like','%-'.$category->id.'-%')->where('is_directory',0)->pluck('id');
            $solids=Product::query()->whereIn('category_id',$ids)->where('on_sale',1)->limit(5)->get();
            $much=true;
        }
        if(!$category->is_directory){
            $categories=Category::query()->with(['products'])->find($category->id);
            $solids=Product::query()->where('on_sale',1)->where('category_id',$category->id)->limit(5)->get();
            $much=false;
        }
//        dd($categories);
//        查询销售最多，上架，评分最高，查询5条的商品展示到solids

        return view('categories.index',['categories'=>$categories,'solids'=>$solids,'much'=>$much]);
    }
}
