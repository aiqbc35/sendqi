<?php

namespace App\Http\Controllers\Cont;


use App\Http\Controllers\Controller;
use App\Logs;

class LogController extends Controller
{
    /**
     * 写入日志
     * @param $type 错误类型
     * @param $value 错误内容
     * @param $function  错误发生所在方法
     * @param $class  错误发生所在类
     */
    static public function noteError($type,$value,$function,$class)
    {
        $class = get_class($class);
        if (is_null($type) || empty($value)) {
            return;
        }else{
            return Logs::create([
                'type' => $type,
                'value' => $value,
                'function' => $function,
                'class' => $class,
                'addtime' => time()
            ]);
        }

    }
}