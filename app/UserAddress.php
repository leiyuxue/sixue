<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
   protected $fillable=['contact_name','contact_phone','province','city','district','address','tag','last_used_at'];
//   指定last_used_at时间为carbon日期对象
   protected $dates=['last_used_at'];
   protected $appends=['full_address'];
//   与用户表关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//    获取完整地址
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }
}
