<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QiSky在線視頻</title>
    <link href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css" rel="stylesheet">
    <link href="/dist/style.css?v0.5" rel="stylesheet">
    @yield('css')
</head>
<body ontouchstart>
<div class="container margin-bottom-60" id="container">
    <div class="page navbar js_show">
        <div class="page__bd" style="height: 100%;">
            <div class="weui-tab">
                <div class="weui-navbar">
                    <div class="weui-navbar__item background-common">
                        QISKY視頻
                    </div>
                </div>
                <div class="weui-tab__panel">

                </div>
            </div>
            @yield('content')

        </div>

    </div>
</div>

<div class="weui-tab bottom-mune-bar">
    <div class="weui-tab__panel">

    </div>
    <div class="weui-tabbar">
        <a href="/mobile/index" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/index' ? 'weui-bar__item_on' : ''}}">
                    <span style="display: inline-block;position: relative;">
                        <img src="/dist/images/home-1.png" alt="" class="weui-tabbar__icon">
                    </span>
            <p class="weui-tabbar__label">首页</p>
        </a>
        <a href="/mobile/list" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/list' ? 'weui-bar__item_on' : ''}}">
            <img src="/dist/images/free.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">免费</p>
        </a>
        <a href="/mobile/list-vip" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/list-vip' ? 'weui-bar__item_on' : ''}}">
            <img src="/dist/images/vip.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">VIP</p>
        </a>
        <a href="/mobile/list-long" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/list-long' ? 'weui-bar__item_on' : ''}}">
            <img src="/dist/images/long-1.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">整片</p>
        </a>
        <a href="/mobile/member/index" class="weui-tabbar__item {{ Request::getPathInfo() == '/mobile/member/index' ? 'weui-bar__item_on' : ''}}">
            <img src="/dist/images/me.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">我</p>
        </a>
    </div>
</div>
<div id="loadingToast" style="opacity: 0; display: none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">数据加载中</p>
    </div>
</div>
<div id="alert-info"></div>
<script src="/dist/js/zepto.min.js"></script>
<script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<script src="/dist/js/common.js?v0.1"></script>
@yield('script')
</body>
</html>