@extends('Common.Home')
@section('content')
    <div class="container">
        <div class="sun-title">
            <h3>免費視頻</h3>
            <span>網站不定時會更新免費視頻，並且提供多線路高速視頻瀏覽</span>
        </div>
        <div class="row" id="video-free">

        </div>
        <nav aria-label="..." id="page-js">
            <ul class="pager">
                <li class="disabled"><a href="#">首页</a></li>
                <li><a href="#">上一页</a></li>
                <li><a href="#">下一页</a></li>
                <li><a href="#">末页</a></li>
            </ul>
        </nav>
    </div>

@include('Common.RegLogin')
@stop
@section('script')
    <script type="application/javascript" src="/js/list.js?v0.1"></script>
    @stop