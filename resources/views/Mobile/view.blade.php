@extends('Common.Mobile')
@section('css')
    <link href="/plugin/video.js-6.7.4/video-js.css" rel="stylesheet">
@stop
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item">
            <div class="placeholder">
                <video id="example-video" height="235" style="width: 100%;" preload="auto" poster="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1519838760058&di=cb2de26484f5bce5bc11bd95a0270d84&imgtype=0&src=http%3A%2F%2Fpic1.win4000.com%2Fwallpaper%2F2017-12-19%2F5a387ccbaddb7.jpg" class="video-js vjs-big-play-centered fod-vjs-default-skin vjs-paused vjs-controls-enabled vjs-workinghover vjs-mux fod-vjs-embed videoPlayer-25c17d6eb2-dimensions vjs-user-inactive godskyvideoplay" controls>
                    <source src="https://d2zihajmogu5jn.cloudfront.net/bipbop-advanced/bipbop_16x9_variant.m3u8" type="application/x-mpegURL" id="videourl">
                    <p class="vjs-no-js">您的浏览器不支持HTML5，请更换浏览器尝试！</p>
                </video>
                <p class="title">标题：<span></span></p>
            </div>
        </div>
    </div>
    <div class="weui-cells" style="margin-top: 0px;">
        <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">线路选择</div>
        </div>
    </div>
    <div class="weui-flex line-service paading-left-03">
        <div class="weui-flex__item">
            <div class="placeholder" id="service-line"></div>
        </div>
    </div>
    <div class="weui-cells" style="margin-top: 0px;">
        <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">随机推荐</div>
        </div>
    </div>
    <div id="long" class="font-size-03"></div>
@stop
@section('script')
    <script src="/plugin/video.js-6.7.4/video.js"></script>
    <script src="/plugin/videojs-hls/videojs-contrib-hls.min.js"></script>
    <script type="application/javascript" src="/dist/js/view.js?v0.1"></script>
@stop