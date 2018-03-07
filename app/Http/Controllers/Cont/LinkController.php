<?php

namespace App\Http\Controllers\Cont;

use App\Http\Controllers\Controller;
use App\Links;

class LinkController extends Controller
{
    /**
     * 查询友情链接列表
     * @return mixed
     */
    public function getList()
    {
        $links = Links::get();
        return $links;
    }
}