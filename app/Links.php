<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';

    public $timestamps = false;

    protected $fillable = ['title','link','sort'];
}
