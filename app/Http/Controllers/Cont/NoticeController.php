<?php

namespace App\Http\Controllers\Cont;

use App\Http\Controllers\Controller;
use App\Notice;

class NoticeController extends Controller
{
    /**
     * 获取通知
     * @param string $limit  条数 档位空时就全部取出
     * @return null
     */
    public function getNotice($limit = '')
    {
        $result = null;
        if (empty($limit)) {
            $result = Notice::get();
        }else{
            $result = Notice::orderBy('id','desc')
                ->offset(0)
                ->limit($limit)
                ->get();
        }
        return $result;
    }
}