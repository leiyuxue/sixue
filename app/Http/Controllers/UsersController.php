<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
//    账号
    public function account(User $user,$type='security')
    {
        return view('users.account',compact('type'));
    }
//    个人中心
    public function personal(User $user,$type='address')
    {
        $orderId=isset($_GET['id'])?$_GET['id']:0;
        $this->authorize('own',$user);
        $user=User::with(['addresses','favoriteProducts','orders'=>function($query) use($orderId){
            if($orderId>0){
               return $query->with(['couponCode','orderItems'=>function($query){
                    $query->with(['product','productSku']);
                }])->find($orderId);
            }else{
                $query->with(['couponCode','orderItems'=>function($query){
                    $query->with(['product','productSku']);
                }]);
            }

        }])->find($user->id);
        return view('users.personal',['user'=>$user,'type'=>$type]);
    }
}
