<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'log';

    public $timestamps = false;

    protected $fillable = ['type','value','function','class','addtime'];
}
