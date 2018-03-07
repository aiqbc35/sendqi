<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = ['username','password','addtime','ismobile','logintime'];
}