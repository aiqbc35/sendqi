@extends('Common.Home')
@section('css')
    <link href="https://cdn.bootcss.com/video.js/6.6.2/video-js.css" rel="stylesheet">
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="view-play-title"></div>
                <video id="example-video" height="340" preload="auto" poster="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1519838760058&di=cb2de26484f5bce5bc11bd95a0270d84&imgtype=0&src=http%3A%2F%2Fpic1.win4000.com%2Fwallpaper%2F2017-12-19%2F5a387ccbaddb7.jpg" class="video-js vjs-big-play-centered fod-vjs-default-skin vjs-paused vjs-controls-enabled vjs-workinghover vjs-mux fod-vjs-embed videoPlayer-25c17d6eb2-dimensions vjs-user-inactive godskyvideoplay" controls>
                    <source src="" type="application/x-mpegURL" id="videourl">
                    <p class="vjs-no-js">您的浏览器不支持HTML5，请更换浏览器尝试！</p>
                </video>
            </div>
            <div class="col-md-12">
                <div class="line-list">
                </div>
            </div>
        </div>
    </div>
    <div class="line-hr" style="margin-top: 30px;"></div>
    <div class="row">
        <div class="col-md-12">
            @if(Session()->has('USER_INFO_CACHE'))
                <a href="/member/vip">
                    @else
                        <a href="javascript:;" data-toggle="modal" data-target="#exampleModal">
                            @endif
                            <img src="/demo/view.gif" alt="" style="width: 100%;">
                        </a>
        </div>
    </div>
    <div class="container">
        <div class="sun-title">
            <h3>隨機推薦</h3>
        </div>
        <div class="row" id="rand_video">

        </div>
    </div>
    @include('Common.RegLogin')
@stop
@section('script')
    <script src="https://cdn.bootcss.com/video.js/6.6.2/video.js"></script>
    <script src="https://cdn.bootcss.com/videojs-contrib-hls/5.12.2/videojs-contrib-hls.min.js"></script>
    <script type="application/javascript" src="/js/view.js?v0.7"></script>
@stop