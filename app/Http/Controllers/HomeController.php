<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cont\LogController;
use App\Http\Controllers\Cont\NoticeController;
use App\Http\Controllers\Cont\UserController;
use App\Http\Controllers\Cont\VideoController;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * PC首页视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ()
    {

        $data = $this->getTopvideoNotice();

        return view('Home.index',[
            'topVideo' => $data['topvideo'],
            'notice' => $data['notice'],
        ]);
    }

    /**
     * 获取banner以及通知数据
     * @return array
     */
    public function getTopvideoNotice()
    {
        //Cache::forget('TopvideoNotice');
        if (Cache::has('TopvideoNotice')) {
            return Cache::get('TopvideoNotice');
        }else{
            $topVideo = (new VideoController())->getTopVideo();
            $topVideo = VideoController::sqlToData($topVideo);
            $notice = (new NoticeController())->getNotice(3);

            if (empty($topVideo)) {
                LogController::noteError('ErrorEmpty','首页banner数据为空',__FUNCTION__,$this);
            }
            $data = [
                'topvideo' => $topVideo,
                'notice' => $notice
            ];

            Cache::put('TopvideoNotice',$data,3600);
            return $data;
        }
    }

    /**
     * 免费视频视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lists()
    {
       return view('Home.list');
    }

    /**
     * VIP视频视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listvip()
    {
        return view('Home.listvip');
    }

    /**
     * VIP长片视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listlong()
    {
        return view('Home.listlong');
    }

    /**
     * 会员中心视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function member()
    {
       $session_user_info = (new UserController())::getUserCache();

        return view('Home.member',[
            'user' => $session_user_info
        ]);
    }

    /**
     * 升级VIP视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vip()
    {
        return view('Home.vip');
    }

    public function pageview()
    {
        return view('Home.view');
    }
}