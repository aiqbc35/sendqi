<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Cont\UserController;

class MobileController extends Controller
{
    /**
     * 移动端首页视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = (new HomeController())->getTopvideoNotice();
        //dd($data);
        return view('Mobile.index',[
            'video' => $data['topvideo']
        ]);
    }

    /**
     * 免费列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView()
    {
        return view('Mobile.list');
    }

    /**
     * VIP视频列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listVipView()
    {
        return view('Mobile.listvip');
    }

    /**
     * 整片列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listLongView()
    {
        return view('Mobile.listlong');
    }

    /**
     *播放页面视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function playView()
    {
        return view('Mobile.view');
    }

    /**
     *注册视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerView()
    {
        return view('Mobile.register');
    }

    /**
     * 登陆视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginView()
    {
        return view('Mobile.login');
    }

    /**
     * 会员中心视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function memberView()
    {
        $session_user_info = (new UserController())::getUserCache();

        return view('Mobile.member',[
            'user' => $session_user_info
        ]);
    }

    /**
     * 个人信息视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userInfoView()
    {
        $session_user_info = (new UserController())::getUserCache();

        return view('Mobile.userinfo',[
            'user' => $session_user_info
        ]);
    }

    /**
     * Vip升级视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userVipView()
    {
        return view('Mobile.uservip');
    }

}
