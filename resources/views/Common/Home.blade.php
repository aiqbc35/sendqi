<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>QiSky在線視頻</title>
    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/layer/3.1.0/theme/default/layer.css" rel="stylesheet">
    @yield('css')
    <link href="/style/style.css?v0.2" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">

        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href="/mobile/index";
        }
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-godsky navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header title">
            qisky
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right font-size-23">
                <li class="{{ Request::getPathInfo() == '/' ? 'active' : ''}}"><a href="/" class="padding-top-36 color-black">首頁</a></li>
                <li class="{{ Request::getPathInfo() == '/list' ? 'active' : ''}}"><a href="/list" class="padding-top-36 color-black">免費視頻</a></li>
                <li class="{{ Request::getPathInfo() == '/list-vip' ? 'active' : ''}}"><a href="/list-vip" class="padding-top-36 color-black">VIP視頻</a></li>
                <li class="{{ Request::getPathInfo() == '/list-long' ? 'active' : ''}}" style="margin-right: 20px;"><a href="list-long" class="padding-top-36 color-black">VIP長片</a></li>
                @if(Session()->has('USER_INFO_CACHE'))
                    <a href="/member/" class="btn btn-blue btn-lg margin-top-20">會員中心</a>
                    <a href="/member/logout" class="btn btn-blue btn-lg margin-top-20">退出</a>
                    @else
                <button type="button" class="btn btn-blue btn-lg margin-top-20" data-toggle="modal" data-target="#exampleModal">註冊</button>
                <button type="button" class="btn btn-blue btn-lg margin-top-20" data-target="#loginModal" data-toggle="modal">登陸</button>
                    @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@yield('content')
<div class="line-hr" style="margin-top: 30px;"></div>
<footer>
    GodSky © 2017-2018 All Rights Reserved Terms of Use and Privacy Policy
</footer>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="loadingModal">
    <div class="modal-dialog" style="width: 280px;margin: 268px auto;" role="document">
        <div class="modal-content" style="height:106px;background-color: initial !important;">
            <div class="loading">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script src="/js/common.js?v0.3"></script>
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