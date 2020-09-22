<?php

namespace App\Admin\Controllers;

use App\CouponCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CouponCodesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '优惠卷';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CouponCode());
        $grid->model()->orderBy('created_at','desc');
        $grid->column('id','编号')->sortable();
        $grid->column('name', '优惠卷名称');
        $grid->column('type', '优惠卷类型')->display(function($v){
            return CouponCode::$TypeMap[$v];
        });
        $grid->column('code', '优惠码');
        $grid->column('description', '描述');
        $grid->column('min_price','使用最低价格');
        $grid->column('amount', '发放总数');
        $grid->column('used', '使用数量')->display(function($value){
            return "{$value}/{$this->amount}";
        });
        $grid->column('use_start_time', '开始时间');
        $grid->column('use_end_time', '结束时间');
        $grid->column('enable', '是否启用')->display(function($v){
            return $v?'启用':'未启用';
        });
        $grid->column('created_at', '创建时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(CouponCode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('type', __('Type'));
        $show->field('code', __('Code'));
        $show->field('value', __('Value'));
        $show->field('min_price', __('Min price'));
        $show->field('amount', __('Amount'));
        $show->field('used', __('Used'));
        $show->field('use_start_time', __('Use start time'));
        $show->field('use_end_time', __('Use end time'));
        $show->field('enable', __('Enable'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CouponCode());

        $form->text('name','优惠卷名称')->rules('required');
        $form->radio('type','类型')->options(CouponCode::$TypeMap)->rules('required')->default(CouponCode::TYPE_FIXED);
        $form->text('code', '优惠码')->rules(function($form) {
            // 如果 $form->model()->id 不为空，代表是编辑操作
            if ($id = $form->model()->id) {
                return 'nullable|unique:coupon_codes,code,'.$id.',id';
            } else {
                return 'nullable|unique:coupon_codes';
            }
        });
        $form->text('value', '折扣')->rules(function($form){
            if(request()->input('type')===CouponCode::TYPE_FIXED){
                return 'required|numeric|min:0.01';
            }else{
                return 'required|numeric|between:1,99';
            }
        });
        $form->text('min_price','最低价格')->rules('required|numeric|min:0');
        $form->text('amount', '发放数量')->rules('required|numeric|min:0');
        $form->text('used', '使用量')->default(0)->rules('required|numeric|min:0');
        $form->datetime('use_start_time','开始使用时间')->default(date('Y-m-d H:i:s'));
        $form->datetime('use_end_time', '结束使用时间')->default(date('Y-m-d H:i:s'));
        $form->switch('enable', '是否启用');

        $form->saving(function(Form $form){
            if(!$form->input('code')){
                $form->code=CouponCode::makeCouponCode();
            }
        });

        return $form;
    }
}
