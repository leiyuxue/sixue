<?php

namespace App\Http\Requests;

use App\ProductSku;
use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends FormRequest
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
            'product_sku_id'=>[
                'required',function($attr,$value,$fail){
//                    查询sku单品是否存在
                    if(!$sku=ProductSku::find($value)){
                        return $fail('该商品不存在');
                    }
//                    查询该单品是否上架
                    if(!$sku->product->on_sale){
                        return $fail('该商品未上架');
                    }
//                    查询库存
                    if($sku->stock===0){
                        return $fail('该商品库存不足');
                    }
                }
            ],
            'amount'=>['required','integer','min:1']
        ];
    }

    public function attributes()
    {
        return [
            'amount'=>'商品数量'
        ];
    }

    public function messages()
    {
        return [
            'product_sku_id.required'=>'请选择商品'
        ];
    }
}
