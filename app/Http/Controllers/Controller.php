<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 统一输出返回数组格式
     * @param $status  状态码 0为失败
     * @param $msg 错误信息
     * @return array
     */
    static protected function ResponseArray($status,$msg = '')
    {
        return [
            'status' => $status,
            'message' => $msg,
        ];
    }
    /**
     * Api数据统一输出
     * @param $status 状态码，1：成功 0：失败
     * @param string $message 提示词
     * @param null $data 反馈数据
     * @return array 输出JSON
     */
    static public function ResponseJson($status = 0,$message = '',$data = null)
    {
        $code = 'ERROR';
        if ($status === 1)
        {
            $code = 'success';
        }
        $result = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($result);
    }
}
