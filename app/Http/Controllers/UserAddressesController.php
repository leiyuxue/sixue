<?php

namespace App\Http\Controllers;

use App\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    //添加收货地址
    public function store(Request $request)
    {
       return $request->user()->addresses()->create($request->only(['province','city','district','address','contact_name','contact_phone','tag']));
    }
//    修改收货地址
    public function update(UserAddress $user_address,Request $request)
    {
        $this->authorize('own',$user_address);
       return $user_address->update($request->only(['province','city','district','address','contact_name','contact_phone','tag']));
    }
//    删除收货地址
    public function destroy(UserAddress $user_address)
    {
        $this->authorize('own',$user_address);
        return $user_address->delete();
    }


}
