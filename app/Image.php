<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=['type','path'];
//    关联用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
