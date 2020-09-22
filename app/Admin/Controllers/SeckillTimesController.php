<?php

namespace App\Admin\Controllers;

use App\SeckillTime;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class SeckillTimesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '秒杀时间';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeckillTime());

        $grid->column('id', __('编号'));
        $grid->column('start_at', __('开始时间'));
        $grid->column('end_at', __('结束时间'));

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SeckillTime());

        $form->time('start_at', __('开始时间'))->default(date('H:i:s'));
        $form->time('end_at', __('结束时间'))->default(date('H:i:s'));

        return $form;
    }

    public function apiSeckillTime(Request $request)
    {
        $search=$request->input('q');
        $seckill_times=SeckillTime::query()->where('start_at','like','%'.$search.'%')->Where('end_at','like','%'.$search.'%')->paginate();

        $seckill_times->setCollection($seckill_times->getCollection()->map(function (SeckillTime $s) {
            return ['id' => $s->id, 'text' => $s->start_at.'-'.$s->end_at];
        }));
        return $seckill_times;
    }
}
