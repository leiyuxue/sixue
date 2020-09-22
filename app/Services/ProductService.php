<?php
namespace App\Services;

use App\Product;
use App\SearchBuilders\ProductSearchBuilder;

class ProductService{
//    获取相似商品的ids
    public function getSimilarProductIds(Product $product,$amount)
    {
        if(count($product->propties)===0){
            return [];
        }
        $builder=(new ProductSearchBuilder())->onSale()->pagination(1,$amount);
        foreach($product->propties as $propty){
            $builder->proptiesFilter($propty->name,$propty->value,'should');
        }
        $builder->minShouldMatch(ceil(count($product->propties)/2));
        $params=$builder->getParams();
//        把当前的商品排除在外面
        $params['body']['query']['bool']['must_not'][]=['term'=>['_id'=>$product->id]];
        $result=app('es')->search($params);
        return collect($result['hits']['hits'])->pluck('_id')->all();
    }
}
