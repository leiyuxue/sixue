<?php

namespace App\Admin\Controllers;

use App\Solider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SolidersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Solider';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Solider());

        $grid->column('id', '编号');
        $grid->column('title', '标题');
        $grid->column('img', '图片');
        $grid->column('link','链接地址');
        $grid->column('enable','是否开启')->display(function($value){
            return $value?'是':'否';
        });

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
        $show = new Show(Solider::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('img', __('Img'));
        $show->field('link', __('Link'));
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
        $form = new Form(new Solider());

        $form->text('title','标题');
        $form->image('img','图片地址');
        $form->url('link', '链接地址');
        $form->switch('enable', '是否开启')->default(1);

        return $form;
    }
}
