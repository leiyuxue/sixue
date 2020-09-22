<?php

namespace App\Http\Requests;

use App\ProductSku;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id'=>[
                'required',
                Rule::exists('user_addresses','id')->where('user_id',$this->user()->id),
            ],
            'cart_items'=>[
                'required','array'
            ],
            'cart_items.*.product_sku_id'=>[
                'required',
                function($attr,$value,$fail){
                    if(!$productSku=ProductSku::find($value)){
                        return $fail('该商品不存在');
                    }
                    if(!$productSku->product->on_sale){
                        return $fail('该商品未上架');
                    }
                    preg_match('/cart_items\.(\d+)\.product_sku_id/',$attr,$m);
                    $index=$m[1];
                    $amount=$this->input('cart_item')[$index].['amount'];
                    if($productSku->stock<$amount && $amount>0){
                        return $fail('该商品库存不足');
                    }
                }
            ],
            'cart_items.*.amount'=>[
                'required','min:1','integer'
            ],
        ];
    }
}
