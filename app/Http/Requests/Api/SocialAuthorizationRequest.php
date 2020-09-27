<?php

namespace App\Http\Requests\Api;

class SocialAuthorizationRequest extends FormRequest
{

    public function rules()
    {
//        要么提交code要么提交access_token和openid
        $rules=[
            'code'=>'required_without:access_token|string',
            'access_token'=>'required_code|string',
        ];
//        只有微信登录才有openid,并且code不存在的时候才会提交openid
        if($this->social_type=='wechat' && !$this->code){
            $rules['openid']='required|string';
        }
        return $rules;
    }
}
