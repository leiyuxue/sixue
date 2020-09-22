<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class InvalidRequestException extends Exception
{
    //用户触发的异常，把错误信息返回给用户
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request)
    {
        if($request->expectsJson()){ //如果请求是ajax请求，直接返回json数据
            return response()->json(['msg'=>$this->message],$this->code);
        }
//        不是ajax请求直接返回错误页面，响应给用户
        return view('pages.error',['msg'=>$this->message]);
    }
}
