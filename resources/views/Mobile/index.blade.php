@extends('Common.Mobile')
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item">
            <div class="placeholder">
                <div id="picPanel" class="pic-panel">
                    <div id="picBox" class="pic-box">
                        <ul id="picList" class="pic-list">
                            @foreach($video as $value)
                            <li>
                                <a href="/mobile/view?id={{ $value['id'] }}">
                                    <img src="{{ $value['thumb'] }}" />
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="weui-flex son-title">
        <div class="weui-flex__item margin-top-06">
            <div class="placeholder">
                <span class="right-arrow"></span>
                <span class="son-title-span">免费视频</span>
            </div>
        </div>
    </div>
    <div id="free" class="font-size-03"></div>
    <div class="weui-flex son-title">
        <div class="weui-flex__item margin-top-06">
            <div class="placeholder">
                <span class="right-arrow"></span>
                <span class="son-title-span">VIP视频</span>
            </div>
        </div>
    </div>
    <div id="vip" class="font-size-03"></div>
    <div class="weui-flex son-title">
        <div class="weui-flex__item margin-top-06">
            <div class="placeholder">
                <span class="right-arrow"></span>
                <span class="son-title-span">VIP整片视频</span>
            </div>
        </div>
    </div>
    <div id="long" class="font-size-03"></div>
@stop
@section('script')
<script src="/dist/js/photoSlider-1.21.js"></script>
<script src="/dist/js/index.js?v0.1"></script>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        photoSlide({
            wrap: document.getElementById('picBox'),
            loop: true,
            autoPlay: true,
            autoTime: 4000,
            pagination: true
        });
    }, false);
</script>
@stop
