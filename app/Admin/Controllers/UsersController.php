<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Make a grid builder.
     * 列表页面显示所有列
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->id('ID');
        $grid->name('用户名');
        $grid->email('邮箱');
        $grid->phone('手机号码');
        $grid->avatar('头像');
        $grid->introduction('描述');
        $grid->email_verified_at('以验证邮箱')->display(function($value){
            return $value?'是':'否';
        });
        $grid->created_at('注册时间');
//      新建按钮
        $grid->disableCreateButton();
//      同一行不显示编辑按钮
        $grid->disableActions();
        $grid->tools(function($tools){
//            禁用批量删除按钮
            $tools->batch(function($batch){
                $batch->disableDelete();
            });
        });
        return $grid;
    }

    /**
     * Make a show builder.
     * 详情页面 列出所有字段
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('avatar', __('Avatar'));
        $show->field('introduction', __('Introduction'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *编辑和创建
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->mobile('phone', __('Phone'));
        $form->image('avatar', __('Avatar'));
        $form->text('introduction', __('Introduction'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}
