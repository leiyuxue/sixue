<?php

namespace App\Admin\Controllers;

use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class CategoriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品类目';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', '编号');
        $grid->column('name', '名称');
        $grid->column('parent_id', '父级id');
        $grid->column('level','层级');
        $grid->column('is_directory', '是否目录')->display(function($value){
            return $value?'是':'否';
        });
        $grid->column('is_show','是否首页显示')->display(function($value){
            return $value?'是':'否';
        });
        $grid->column('path', '父级路径');
        $grid->actions(function($actions){
            $actions->disableView();
        });

        return $grid;
    }

    public function apiSearchCategory(Request $request)
    {
        $field=$request->input('q');
        $result=Category::query()->where('is_directory',boolval($request->input('is_directory',true)))->where('name','like','%'.$field.'%')->paginate();
        // 把查询出来的结果重新组装成 Laravel-Admin 需要的格式
        $result->setCollection($result->getCollection()->map(function (Category $category) {
            return ['id' => $category->id, 'text' => $category->parent_full_name];
        }));

        return $result;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('parent_id', __('Parent id'));
        $show->field('level', __('Level'));
        $show->field('is_directory', __('Is directory'));
        $show->field('path', __('Path'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form(true)->edit($id));
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($isEditing=false)
    {
        $form = new Form(new Category());

        $form->text('name', '类目名称')->rules('required');
        $form->radio('is_show','是否首页显示')->options(['1'=>'是','0'=>'否'])->default(1);
        if($isEditing){
            $form->display('is_directory','是否目录')->with(function($value){
               return $value?'是':'否';
            });
            $form->display('parent.name','父类目');
        }else{
            $form->radio('is_directory','是否目录')->options(['1'=>'是','0'=>'否'])->default(0);
            $form->select('parent_id','父类目')->ajax('/admin/api/categories');
        }
        $form->image('ximg','首页展示横向分类图片')->help('父级id为空的时候上传');
        return $form;
    }
}
