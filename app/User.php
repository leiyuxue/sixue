<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,DefaultDatetimeFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','avatar','introduction','email_verified_at','remember_token','weixin_openid','weixin_unionid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'weixin_openid', 'weixin_unionid'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
//    用户表关联收货地址
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
//    用户关联收藏
    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class,'user_favorite_products')->withTimestamps()->orderBy('user_favorite_products.created_at','desc');
    }
//    用户关联购物车
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

//    用户关联订单
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

//    关联图片
    public function images()
    {
        return $this->hasMany(Image::class);
    }

//    api注册加密密码
    public function setPasswordAttribute($value)
    {
        if(strlen($value)!=60){
            $value=bcrypt($value);
        }
        $this->attributes['password']=$value;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
