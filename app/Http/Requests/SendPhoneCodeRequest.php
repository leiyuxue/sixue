<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendPhoneCodeRequest extends FormRequest
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
     * 发送手机验证码验证
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                'unique:users'
            ]
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>'手机号必须填写',
            'phone.regex'=>'手机号码格式错误',
            'phone.unique'=>'手机号码已经注册',
        ];
    }
}
