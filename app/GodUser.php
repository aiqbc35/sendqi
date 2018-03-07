<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GodUser extends Model
{
    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = ['username','password','addtime','logintime','ismobile'];
    //隐藏密码
    protected $hidden = [
        'password'
    ];

}
