<?php

namespace App\Admin\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
class OrdersController extends AdminController
{
    use ValidatesRequests;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id','编号');
        $grid->column('no', '订单号');
        $grid->column('user.phone', '买家');
        $grid->column('total_amount','总金额')->sortable();
        $grid->column('paid_at','支付时间')->sortable();
        $grid->column('refund_status', '退款状态')->display(function($value){
            return Order::$refundStatusMap[$value];
        });
        $grid->column('ship_status','物流状态')->display(function($value){
            return Order::$shipStatusMap[$value];
        });
//        禁用创建按钮
        $grid->disableCreateButton();
//        禁用编辑和删除按钮
        $grid->actions(function($actions){
            $actions->disableDelete();
            $actions->disableEdit();
        });
//        禁用批量删除
        $grid->tools(function($tools){
            $tools->batch(function($batch){
                $batch->disableDelete();
            });
        });
        return $grid;
    }
    /***
     * 发货
     *
     */
    public function ship(Order $order,Request $request)
    {
//        更新前提
        if(!$order->paid_at){
            throw new InvalidRequestException('该商品未付款');
        }
        if($order->ship_status!=Order::SHIP_STATUS_PENDING){
            throw new InvalidRequestException('该订单已经发货');
        }

        $data=$this->validate($request,[
            'express_company'=>'required',
            'express_no'=>'required'
        ],[],[
            'express_company'=>'物流公司',
            'express_no'=>'物流单号'
        ]);
//        更新订单的物流信息
        $order->update([
            'ship_status'=>Order::SHIP_STATUS_DELIVERED,
//            模型中$cast里面指定了是数组形式，所以直接存入
            'ship_data'=>$data,
        ]);
//        返回上一页
        return redirect()->back();

    }
    /**
     *
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id,Content $content)
    {
//        return $content->header('查看订单')->body(view('admin.orders.detail',['order'=>Order::find($id)]));
    }

    public function show($id,Content $content)
    {
        return $content->header('查看订单')->body(view('admin.orders.detail',['order'=>Order::find($id)]));
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('no', __('No'));
        $form->number('user_id', __('User id'));
        $form->textarea('address', __('Address'));
        $form->decimal('total_amount', __('Total amount'));
        $form->textarea('remark', __('Remark'));
        $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
        $form->text('payment_method', __('Payment method'));
        $form->text('payment_no', __('Payment no'));
        $form->text('refund_status', __('Refund status'));
        $form->text('refund_no', __('Refund no'));
        $form->switch('closed', __('Closed'));
        $form->switch('reviewed', __('Reviewed'));
        $form->text('ship_status', __('Ship status'));
        $form->textarea('ship_data', __('Ship data'));
        $form->textarea('extra', __('Extra'));

        return $form;
    }
}
