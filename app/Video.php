<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';

    public $timestamps = false;

    protected $fillable = ['name','image','link','hit','addtime','sort','service','status','type','length'];

    public function sort()
    {
        return $this->hasOne('App\Sort','id','sort');
    }
}
