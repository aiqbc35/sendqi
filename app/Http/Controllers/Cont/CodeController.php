<?php

namespace App\Http\Controllers\Cont;


use App\Code;
use App\CodeLog;
use App\GodUser;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class CodeController extends Controller
{
    static private $code;
    static private $user;

    /**
     * 激活激活码
     * @param Request $request
     * @return array
     */
    public function actionCode(Request $request)
    {
        $code = $request->get('code');
        if ($code == '') {
            return self::ResponseJson(0, '激活码不能为空');
        }

        $userModel = (new UserController());

        $sessionUser = $userModel::getUserCache();

        if ($sessionUser == false) {

            $updateSession = $userModel::autoLogin();

            if ($updateSession == false) {
                return self::ResponseJson(0, '您已退出');
            }
            $sessionUser = $updateSession;
        }

        self::$user = $sessionUser;

        $resultCode = Code::where('code', '=', $code)
            ->first();
        if (!$resultCode) {
            return self::ResponseJson(0, '激活码不存在');
        }
        if ($resultCode->status == 1) {
            return self::ResponseJson(0, '激活码已使用');
        }

        self::$code = $resultCode;


        $result = $this->updateCode();

        if ($result == false) {
            return self::ResponseJson(0, '激活失败');
        }
        $result = $this->actionUser();

        if ($result) {
            $userModel::setUserCache($sessionUser['id']);
            return self::ResponseJson(1,'激活成功');
        }
        return self::ResponseJson(0,'激活失败');
    }

    /**
     * 更新用户会员状态
     * @return bool
     */
    private function actionUser()
    {
        $user = self::$user;
        $code = self::$code;

        $time = time();
        if ($user['viptype'] == 1) {
            $time = $user['vipstoptime'];
        }

        $endTime = strtotime("+" . $code->type . "day", $time);

        $data = [
            'viptype' => 1,
            'type' => 1,
            'vipstoptime' => $endTime
        ];

        $result = GodUser::where('id', '=', $user['id'])
            ->update($data);

        if ($result) {
            return true;
        }
        Code::where('id', '=', $code->id)
            ->update([
                'status' => 0,
                'updatetime' => '',
                'upuser' => 0
            ]);

        CodeLog::where('code', '=', $code->code)
            ->delete();

        LogController::noteError('updateUserCodeError', '激活用户会员状态错误', __FUNCTION__, $this);

        return false;
    }

    /**
     * 更新激活码状态
     * @return bool
     */
    private function updateCode()
    {
        $code = self::$code;
        $user = self::$user;

        $time = time();

        $data = [
            'status' => 1,
            'updatetime' => $time,
            'upuser' => $user['id']
        ];

        $result = Code::where('id', '=', $code->id)
            ->update($data);

        if (!$result) {
            LogController::noteError('updateCodeError', '更新激活码状态错误', __FUNCTION__, $this);
            return false;
        }

        $endTime = date('Y-m-d', strtotime("+" . $code->type . "day", $time));

        $codeLog = [
            'user_id' => $user['id'],
            'code_id' => $code->id,
            'code' => $code->code,
            'type' => $code->type,
            'username' => $user['username'],
            'addtime' => date('Y-m-d', $time),
            'stoptime' => $endTime
        ];

        $result = CodeLog::create($codeLog);

        if (!$result) {
            Code::where('id', '=', $code->id)
                ->update([
                    'status' => 0,
                    'updatetime' => '',
                    'upuser' => 0
                ]);
            LogController::noteError('updateCodeLogError', '创建激活码日志错误', __FUNCTION__, $this);
            return false;
        }

        return true;

    }

}