<?php


namespace App\Services;


use App\CartItem;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\AddCartRequest;
use Illuminate\Support\Facades\Auth;

class CartService
{
//    购物车列表
    public function get()
    {
        return Auth::user()->cartItems()->with(['productSku.product.skus'])->get();

    }
//    加入购物车
    public function add($sku_id,$amount)
    {
        $user=Auth::user();
//        查询购物车是否存在改商品
        if($cart=$user->cartItems()->where('product_sku_id',$sku_id)->first()){
//            如果存在直接叠加数量
            $cart->update(['amount'=>$cart->amount+$amount]);
        }else{
            $cart=new CartItem(['amount'=>$amount]);
            $cart->user()->associate($user);
            $cart->productSku()->associate($sku_id);
            $cart->save();
        }
        return $cart;
    }
    /***
     * 删除购物车商品
     * $cids 购物车id,可以是一个元素，也可以是数组
     */
    public function remove($cids)
    {
        if(!is_array($cids)){
            $cids=[$cids];
        }
        Auth::user()->cartItems()->whereIn('id',$cids)->delete();
    }
    /***
     * 更新购物车商品数量
     * $cid 购物车id
     * $num 更新的商品数量
     */
    public function upCartNum($cid,$num)
    {
        $cart=CartItem::find($cid);
        $cart->amount=$num;
        $cart->save();
    }
    /***
     * 加入购物车成功页面
     * $cid 购物车id
     *
     */
    public function addCartSuccess($cid)
    {
       return Auth::user()->CartItems()->find($cid);
    }
    /***
     * 下单页面
     *
     */
    public function checkout($cids)
    {
       $data=Auth::user()->CartItems()->with(['productSku.product'])->whereIn('id',$cids)->get();
       if(count($data)==0){
           throw new InvalidRequestException('为选择商品',400);
       }
       return $data;
    }
}
