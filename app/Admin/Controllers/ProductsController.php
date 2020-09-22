<?php

namespace App\Admin\Controllers;

use App\Product;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductsController extends CommonProductsController
{

    public function getProductType()
    {
        return Product::TYPE_NORMAL;
    }
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function customGrid(Grid $grid){
        $grid->model()->with(['category']);
        $grid->id('Id');
        $grid->title('标题');
        $grid->column('category.name','类目');
        $grid->on_sale('以上架')->display(function($value){
            return $value?'是':'否';
        });
        $grid->rating('评分');
        $grid->review_count('评论数');
        $grid->sold_count('销量');
        $grid->price('sku最低价格');
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function customForm(Form $form)
    {
//        普通商品没有任何其他数据，所以不用写东西
    }


}
