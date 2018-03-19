<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QiSky在線視頻</title>
    <link href="https://cdn.staticfile.org/weui/1.1.1/style/weui.min.css" rel="stylesheet">
    <link href="/dist/style.css?v0.5" rel="stylesheet">
    @yield('css')
    <script type="text/javascript">

        if (!(navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href="/";
        }
    </script>
</head>
<body ontouchstart>
<div class="container margin-bottom-60" id="container">
    <div class="page navbar js_show">
        <div class="page__hd" style="position: fixed;width: 100%;left: 0;top: 0px;height: 2rem;z-index: 999;">
            <div class="weui-flex">
                <div class="weui-flex__item" style="line-height: 3em;text-align: center;background-color: #dff0d8;color: #3c763d;">
                    @if(Session()->has('USER_INFO_CACHE'))
                    <a href="/mobile/member/vip" style="color: #3c763d;">
                    @else
                            <a href="/mobile/register" style="color: #3c763d;">
                                @endif
                        优惠进行中，VIP只需18元！点击领取
                    </a>
                </div>
            </div>
        </div>
        <div class="page__bd" style="height: 100%; margin-top: 3em;">
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
            <span style="display: inline-block;position: relative;">
            <img src="/dist/images/vip.png" alt="" class="weui-tabbar__icon">
            <span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">18元</span>
                    </span>
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
<script src="/dist/js/common.js?v0.2"></script>
@yield('script')
<div style="display: none">
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b6bb55e5c8cfeee093fc2a91a983142d";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</div>
</body>
</html>