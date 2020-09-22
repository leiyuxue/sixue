<?php

namespace App\Admin\Controllers;

use App\Category;
use App\Product;
use App\SeckillTime;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Http\Request;

class SeckillProductsController extends CommonProductsController
{

    public function getProductType()
    {
        return Product::TYPE_SECKILL;
    }
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '秒杀商品';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function customGrid(Grid $grid)
    {
        $grid->column('id', __('编号'));
        $grid->column('title', __('标题'));
        $grid->column('on_sale', __('是否上架'))->display(function($value){
            return $value?'是':'否';
        });
        $grid->column('price', __('价格'));
        $grid->column('seckill_time.start_at', __('开始时间'));
        $grid->column('seckill_time.end_at', __('结束时间'));

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function customForm(Form $form)
    {
//        秒杀数据
        $form->select('seckill_time_id','选择时间段')->options(function($value){
            $seckill_time=SeckillTime::find($value);
            if($seckill_time){
                return [$seckill_time->id=>$seckill_time->start_at.'-'.$seckill_time->end_at];
            }

        })->ajax('/admin/api/seckill_times');
    }


}
