<?php

namespace App\Admin\Controllers;

use App\Category;
use App\Jobs\SyncOneProductToES;
use App\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

abstract class CommonProductsController extends AdminController{
//    定义类型
    abstract public function getProductType();

//    定义关联外部列表数据
    abstract protected function customGrid(Grid $grid);
//    定义关联外部表单数据
    abstract protected function customForm(Form $form);

//    公共列表数据
    protected function grid()
    {
        $grid = new Grid(new Product());
        $grid->model()->where('type',$this->getProductType())->orderBy('id','desc');

        $this->customGrid($grid);
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });
        return $grid;
    }
//    公共表单数据
    protected function form(){
        $form=new Form(new Product());
        $form->hidden('type','类型')->value($this->getProductType());
        $form->text('title', '商品名称')->rules('required');
        $form->text('long_title', '商品长标题')->rules('required');
        $form->select('category_id','商品类目')->options(function($cid){
            $category=Category::find($cid);
            if($category){
                return [$category->id=>$category->parent_full_name];
            }
        })->ajax('/admin/api/categories?is_directory=0')->rules('required');
        $form->quill('description','商品描述')->rules('required');
        $form->image('img', '封面图片')->rules('required|image');
        $form->image('flash_img', '幻灯片图片')->rules('required|image');
        $form->switch('on_sale', '是否上架')->default(1);
//        商品概述
        $form->multipleImage('summaries',__('概述'));
//        调用自定义方法
        $this->customForm($form);
//        商品销售属性
        $form->hasMany('skus','sku列表',function($form){
            $form->text('title','sku 名称')->rules('required');
            $form->text('description','sku 描述')->rules('required');
            $form->text('price','单价')->rules('required|numeric|min:0.01');
            $form->text('stock','剩余库存')->rules('required|integer|min:0');
            $form->image('imgs','图片');
        });

//        商品非销售属性
//         放在 SKU 下面
        $form->hasMany('propties', '商品属性', function (Form\NestedForm $form) {
            $form->text('name', '属性名')->rules('required');
            $form->text('value', '属性值')->rules('required');
        });

        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
        });
        $form->saved(function(Form $form){
            $product=$form->model();
            dispatch(new SyncOneProductToES($product));
        });
        return $form;
    }
}
