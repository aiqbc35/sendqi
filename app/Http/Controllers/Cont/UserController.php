<?php

namespace App\Http\Controllers\Cont;


use App\GodUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    //用户信息缓存
    const USER_INFO_SESSION = 'USER_INFO_CACHE';
    //用户COOKIE
    const USER_INFO_COOKIE = 'USER_INFO_COOKIE';

    /**
     * 检测用户名是否存在API
     * @param Request $request
     * @return array
     */
    public function checkUser(Request $request)
    {
        $email =  $request->get('email');
        $result = self::checkUserFormat($email);

        return self::ResponseJson($result['status'],$result['message']);
    }

    /**
     * 用户登陆
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $email = $request->get('email');
        $pwd = $request->get('pwd');
        $retsultEmail = self::emailFormat($email);
        if ($retsultEmail['status'] != 1) {
            return self::ResponseJson($retsultEmail['status'],$retsultEmail['message']);
        }
        if (empty($pwd)) {
            return self::ResponseJson(0,'密码不能为空');
        }
        $pwd = md5($pwd);
        $result = GodUser::where('username','=',$email)
            ->where('password','=',$pwd)
            ->first();
        if (empty($result)) {
            return self::ResponseJson(0,'账号或密码错误');
        }

        $cache = self::setUserCache($result->id);
        if ($cache == false) {
            LogController::noteError('userEmpty','用户登陆缓存为空',__FUNCTION__,$this);
        }
        self::updateUserVipStatus($cache);

        self::setUserCookie($result->id);

        VideoServiceController::clearVideoServiceCookie();

        $url = URL('/member');
        return self::ResponseJson(1,'登陆成功',['url'=>$url]);
    }
    /**
     * 用户注册
     * @param Request $request
     * @return array
     */
    public function regUser(Request $request)
    {
        $email = $request->get('email');
        $pwd = $request->get('pwd');
        $pwdq = $request->get('pwdq');
        $serviceType = $request->get('type');

        $retsultEmail = self::checkUserFormat($email);
        if ($retsultEmail['status'] != 1) {
            return self::ResponseJson($retsultEmail['status'],$retsultEmail['message']);
        }
        if ($pwd != $pwdq || empty($pwd)) {
            return self::ResponseJson(0,'两次密码不一致');
        }

        $result = $this->createUser($email,$pwd,$serviceType);

        if (!$result) {
            return self::ResponseJson(0,'创建用户失败');
        }

        $cache = self::setUserCache($result->id);

        if ($cache === false) {
            LogController::noteError('userEmpty','用户注册缓存为空',__FUNCTION__,$this);
        }
        //写入COOKIE
        self::setUserCookie($result->id);
        $url = URL('/member');
        return self::ResponseJson(1,'注册成功',['url'=>$url]);
    }

    /**
     * 写入用户缓存
     * @param $id  用户ID
     * @return bool
     */
    static public function setUserCache($id)
    {
        $info = GodUser::find($id);
        if (empty($info)) {
            return false;
        }
        $userInfo = $info->toArray();

        Session()->put(self::USER_INFO_SESSION,$userInfo);
        return $userInfo;
    }

    /**
     * 获取用户缓存
     * @return bool
     */
    static public function getUserCache()
    {

        if (!Session()->has(self::USER_INFO_SESSION)) {
            return false;
        }
        return Session()->get(self::USER_INFO_SESSION);
    }

    /**
     * 写入Cookie
     * @param $id
     */
    static private function setUserCookie($id)
    {
        Cookie::queue(self::USER_INFO_COOKIE,$id,3600);
    }

    /**
     * 获取用户Cookie
     * @return bool|string
     */
    static private function getUserCookie()
    {

        if (!Cookie::has(self::USER_INFO_COOKIE)) {
            return false;
        }
        return Cookie::get(self::USER_INFO_COOKIE);
    }

    /**
     * 创建用户
     * @param $email  邮箱
     * @param $passwd  密码
     * @param string $type  客户端类型 pc or mobile
     * @return bool
     */
    private function createUser($email,$passwd,$type = 'pc')
    {
        if (empty($email) || $passwd == '') {
            return false;
        }
        $time = time();

        $result = GodUser::create([
            'username' => $email,
            'password' => md5($passwd),
            'addtime' => $time,
            'logintime' => $time,
            'ismobile' => $type
        ]);
        return $result;
    }

    /**
     * 检测用户是否已存在
     * @param $email
     * @return array
     */
    static private function checkUserFormat($email)
    {
        $checkEmail = self::emailFormat($email);
        if ($checkEmail['status'] != 1) {
            return $checkEmail;
        }
        $user = self::getUserOne(['key'=>'username','value'=>$email]);
        if ($user) {
            return self::ResponseArray(0,'用户已存在');
        }
        return self::ResponseArray(1);
    }

    /**
     * 查询用户
     * @param $user 包含两个内容 key=>键名  value=>内容
     * @return mixed
     */
    static private function getUserOne($user)
    {
        $result = GodUser::where($user['key'],'=',$user['value'])
            ->first();
        return $result;
    }

    /**
     * 验证邮箱格式是否合法
     * @param $email
     * @return array
     */
    static private function emailFormat($email)
{
        if (empty($email)) {
            return self::ResponseArray(0,'邮箱不能为空');
        }
        //php filter_var 验证函数 验证邮箱是否合法
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            return self::ResponseArray(0,'错误的邮箱格式');
        }
        return self::ResponseArray(1);
}

    /**
     * 自动登陆
     * @return bool
     */
    static public function autoLogin()
    {

        $session = self::getUserCache();
        if ($session) {
            return $session;
        }

        $cookie = self::getUserCookie();

        if ($cookie) {

            $result = self::setUserCache($cookie);

            if ($result) {
                self::setUserCookie($result['id']);
                self::updateUserVipStatus($result);

                return $result;
            }
            \setcookie(self::USER_INFO_COOKIE,'',-1,'/');
            VideoServiceController::clearVideoServiceCookie();
            return false;
        }
        return false;
    }

    /**
     * 退出
     * @return $this
     */
    public function logout()
    {
        Session()->forget(self::USER_INFO_SESSION);

        $cookie = Cookie::forget(self::USER_INFO_COOKIE);
        VideoServiceController::clearVideoServiceCookie();
        return redirect('/')->withCookie($cookie);
    }

    /**
     * 修改邮箱
     * @param Request $request
     * @return array
     */
    public function updateEmail(Request $request)
    {
        $email = $request->get('email');
        $pwd = $request->get('pwd');

       $checkEmail = self::emailFormat($email);

       if ($checkEmail['status'] != 1) {
           return self::ResponseJson($checkEmail['status'],$checkEmail['message']);
       }
        if (empty($pwd)) {
            return self::ResponseJson(0,'密码不能为空');
        }

       $getEmail = self::getUserOne(['key'=>'username','value'=>$email]);

        $sessionUser = self::getUserCache();

        if ($sessionUser == false) {
            return self::ResponseJson(0,'您已退出，请重新登陆!');
        }

        if ($sessionUser['username'] == $email) {
            return self::ResponseJson(0,'邮箱不变，不需要修改');
        }

       if ($getEmail) {

           if ($getEmail->id != $sessionUser['id']) {
                return self::ResponseJson(0,'邮箱已存在，请确认您的邮箱是否正确');
           }

       }

        $pwd = md5($pwd);
        $result = GodUser::where('username','=',$sessionUser['username'])
            ->where('password','=',$pwd)
            ->first();

        if (!$result) {
            return self::ResponseJson(0,'密码错误！');
        }

        $result->username = $email;
        $ret = $result->save();

        if ($ret) {
            self::setUserCache($result->id);
            return self::ResponseJson(1,'修改成功');
        }
        return self::ResponseJson(0,'更新失败');

    }

    /**
     * 修改密码
     * @param Request $request
     * @return array
     */
    public function updatePassword(Request $request)
    {
        $passwd = $request->get('oldpwd');
        $newsPasswd = $request->get('newpwd');
        $newspwd = $request->get('newpasswd');

        if (empty($passwd) || $newspwd == '') {
            return self::ResponseJson(0,'密码不能为空');
        }
        if ($newspwd != $newsPasswd) {
            return self::ResponseJson(0,'两次密码不一致');
        }

        $passwd = md5($passwd);

        $sessionUser = self::getUserCache();

        if ($sessionUser == false) {
            return self::ResponseJson(0,'您已退出，请重新登陆!');
        }

        $result = GodUser::where('username','=',$sessionUser['username'])
            ->where('password','=',$passwd)
            ->first();

        if (!$result) {
            return self::ResponseJson(0,'密码错误！');
        }

        $result->password = md5($newspwd);
        $ret = $result->save();

        if (!$ret) {
            return self::ResponseJson(0,'修改失败');
        }
        return self::ResponseJson(1,'修改成功');

    }

    /**
     * 更新用户会员状态
     * @param $user
     * @return bool
     */
    static private function updateUserVipStatus($user)
    {
        if ($user['viptype'] != 1 || $user['vipstoptime'] == '') {
            return false;
        }

        $time = time();

        if ($time >= $user['vipstoptime']) {

            $data = [
                'type' => 0,
                'viptype' => 0,
                'vipstoptime' => ''
            ];

            $result = GodUser::where('id','=',$user['id'])
                ->update($data);

            if (!$result) {
                LogController::noteError('updateUserVipStatus','更新用户会员状态失败',__function__,'User');
                return false;
            }

            self::setUserCache($user['id']);
            return true;
        }

    }

    /**
     * 判断是否为VIP
     * @return bool [true] 是 [false] 否
     */
    static public function getUserIfVip()
    {
        $user = self::getUserCache();
        if($user['viptype'] != 1 || $user['vipstoptime'] == ''){
            return false;
        }
        return true;
    }

}