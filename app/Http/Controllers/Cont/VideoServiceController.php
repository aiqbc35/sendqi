<?php

namespace App\Http\Controllers\Cont;

use App\VideoService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Request;

class VideoServiceController extends Controller
{

    const VIDEO_SERVICE_COOKIE = 'VIDEO_SERVICE_COOKIE';

    /**
     * 获取默认视频服务器地址
     * @return mixed|string
     */
    public function getOne()
    {

       //\setcookie(self::VIDEO_SERVICE_COOKIE,'',-1,'/');
        $url = self::getCookie();

        if (empty($url)) {
            $service = $this->getServiceAll();

            $user = self::checkUser();

            $line = '';

            if ($user == false) {
                $line = array_rand($service['free'],1);
                $line = $service['free'][$line];
            }else{
                $line = array_rand($service['vip'],1);
                $line = $service['vip'][$line];
            }
            self::setCookie($line['link']);
            $url = $line['link'];
        }

        if (empty($url)) {
            LogController::noteError('videoServiceEmpty','视频服务器地址为空',__FUNCTION__,$this);
        }

        return $url;
    }

    /**
     * 切换视频服务器
     * @param Request $request
     * @return array
     */
    public function changeLine(Request $request)
    {
        $id = $request->get('id');

        if (empty($id)) {
            return self::ResponseJson(0,'请选择有效线路');
        }

        $line = VideoService::find($id);

        if (empty($line)) {
            return self::ResponseJson(0,'线路不存在');
        }

        if ($line->type == 'vip') {

            $user = UserController::getUserIfVip();

            if ($user == false) {
                return self::ResponseJson(0,'您还不是VIP，不能选择VIP线路');
            }

        }

        self::setCookie($line->link);
        return self::ResponseJson(1,'切换成功');

    }

    /**
     * 获取服务器列表API
     * @return array
     */
    public function getList()
    {
        $list = $this->getServiceAll();
        $data = array_merge($list['free'],$list['vip']);
        foreach ($data as $key=>$val){
            unset($data[$key]['link']);
        }
        return self::ResponseJson(1,'',$data);
    }

    /**
     * 获取视频服务器地址COOKIE
     * @return string
     */
    private static function getCookie()
    {

        $url = Cookie::get(self::VIDEO_SERVICE_COOKIE);
        return $url;
    }

    /**
     * 写入缓存
     * @param $url 视频服务器地址
     * @return bool
     */
    private static function setCookie($url)
    {
        if (empty($url)) {
            return false;
        }
        Cookie::queue(self::VIDEO_SERVICE_COOKIE,$url,3600);
    }

    /**
     * 查询视频服务器列表
     * @return array
     */
    private function getServiceAll()
    {
        $data = VideoService::all();
        $free = [];
        $vip = [];

        $data = $data->toArray();

        foreach ($data as $key=>$value){
            if ($value['type'] == 'free') {
                $free[$key]['link'] = $value['link'];
                $free[$key]['name'] = $value['title'];
                $free[$key]['id'] = $value['id'];
            }else if($value['type'] == 'vip'){
                $vip[$key]['link'] = $value['link'];
                $vip[$key]['name'] = $value['title'];
                $vip[$key]['id'] = $value['id'];
            }
        }
        return [
            'free' => $free,
            'vip' => $vip
        ];

    }

    /**
     * 检测用户是否登录时候为VIP
     * 未登录或登录不是VIP返回false 如果是VIP则返回true
     * @return bool
     */
    private static function checkUser()
    {
        $user = (new UserController())::getUserCache();
        if ($user){

            if ($user['viptype'] != 1) {
                return false;
            }
            return true;
        }

        return false;

    }
}
