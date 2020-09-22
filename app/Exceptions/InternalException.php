<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class InternalException extends Exception
{
//    系统异常，不是用户触发的，是系统内部返回的错误、
    protected $msgForUser;
    public function __construct($message = "", $msgForUser='系统内部错误', $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->msgForUser=$msgForUser;
    }

    public function render(Request $request)
    {
        if(!$request->expectsJson()){
            return response()->json(['msg'=>$this->msgForUser],$this->code);
        }
        return view('pages.error',['msg'=>$this->msgForUser]);
    }
}
