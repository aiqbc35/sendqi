<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageService extends Model
{
    //表名称
    protected $table = 'images_service';
    //开启时间自动填充 true 是  false 否
    public $timestamps = false;
}