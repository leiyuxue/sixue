<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\CouponCode;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\AddCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService=$cartService;
    }

    //加入购物车
    public function store(AddCartRequest $request)
    {
       return $this->cartService->add($request->input('product_sku_id'),$request->input('amount'));
    }
//    加入成功跳转页面
    public function addCartSuccess(CartItem $cartItem)
    {


        $this->authorize('own',$cartItem);
        $cartData=$this->cartService->addCartSuccess($cartItem->id);
        return view('cart.show',compact('cartData'));
    }
//    购物车列表
    public function cartList(Request $request)
    {
        $carts=$this->cartService->get();
        $addresses=$request->user()->addresses()->get();
        return view('cart.list',['carts'=>$carts,'addresses'=>$addresses]);
    }
//    删除购物车商品
    public function del(CartItem $cart,Request $request)
    {
        $this->authorize('own',$cart);
        $this->cartService->remove($cart->id);
        return [];
    }
//    删除多个购物车商品
    public function delMore($cids)
    {
        $this->cartService->remove($cids);
        return [];
    }
//    更新购物车商品数量
    public function update_amount(CartItem $cart,Request $request)
    {
        $this->authorize('own',$cart);
        $this->cartService->upCartNum($cart->id,$request->input('num'));
        return [];
    }

//    更新购物车属性
    public function update_attr(CartItem $cart,Request $request)
    {
        $this->authorize('own',$cart);
        $sid=$request->sid;
        $cart->product_sku_id=$sid;
        $cart->save();
        return Auth::user()->cartItems()->with(['productSku.product.skus'])->get();
    }
//    下单页面
    public function checkout(Request $request)
    {
        $r=$request->input('r');
        $ids=explode('.',$r);
        $checkData=$this->cartService->checkout($ids);
        $addresses=$request->user()->addresses()->get();
        $coupon_codes=CouponCode::where('enable',true)->get();
        return view('cart.checkout',['checkData'=>$checkData,'addresses'=>$addresses,'coupon_codes'=>$coupon_codes]);
    }
}
