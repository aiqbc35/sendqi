@extends('Common.Home')
@section('content')
    <div class="container">
        <div class="sun-title">
            <h3>VIP視頻</h3>
            <span>網站每日不定時更新視頻，并提供專享與VIP會員的高速服務器進行觀看</span>
        </div>
        @include('Common.listbanner')
        <div class="row" id="video-vip">
        </div>
        <nav aria-label="..." id="page-js">
            <ul class="pager">
                <li class=""><a href="javascript:;">首页</a></li>
                <li class=""><a href="javascript:;">上一页</a></li>
                <li class=""><a href="javascript:;">下一页</a></li>
                <li class=""><a href="javascript:;">末页</a></li>
            </ul>
        </nav>
    </div>

    @include('Common.RegLogin')
@stop
@section('script')
    <script type="application/javascript" src="/js/list-vip.js?v0.1"></script>
@stop