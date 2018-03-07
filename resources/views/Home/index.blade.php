@extends('Common.Home')
@section('content')
    <div class="container">
        <div class="row banner-index">
            <div class="col-md-8 padding-right-0">
                <!--banner start-->
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($topVideo as $key=>$value)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" @if($key == 0)class="active"@endif></li>
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox" style="height: 300px;">
                        @foreach($topVideo as $key=>$value)
                        <div @if($key == 0)class="item active" @else class="item" @endif>
                            <a href="/view?id={{ $value['id'] }}">
                                <img src="{{ $value['thumb'] }}" alt="{{ $value['title'] }}">
                                <div class="carousel-caption">
                                    {{ $value['title'] }}
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!--end banner-->
            </div>
            <div class="col-md-4">
                <!--note start-->
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($notice as $key=>$value)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" @if($key == 0)aria-expanded="true" @else aria-expanded="false"@endif aria-controls="collapseOne">
                                    {{ $value->title }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                {{ $value->content }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--END NOTE-->
            </div>
        </div>
        <div class="alert alert-blue margin-top-20" role="alert">
            簡訊：Godsky在線視頻網址找回請發送任意內容至wwwgodskyorg@mail.ru或免費註冊本站會員即可自動獲取最新網址。
        </div>
    </div>
    <div class="container">
        <div class="sun-title">
            <h3>免費視頻</h3>
            <span>網站不定時會更新免費視頻，並且提供多線路高速視頻瀏覽</span>
        </div>
        <div class="row" id="freevideo">

        </div>
    </div>
    <div class="line-hr"></div>
    <div class="container">
        <div class="sun-title">
            <h3>VIP視頻</h3>
            <span>網站每日不定時更新視頻，并提供專享與VIP會員的高速服務器進行觀看</span>
        </div>
        <div class="row" id="vipvideo">
        </div>
    </div>
    <div class="line-hr"></div>
    <div class="container">
        <div class="sun-title">
            <h3>VIP長片</h3>
            <span>網站每日不定時更新視頻，并提供專享與VIP會員的高速服務器進行觀看</span>
        </div>
        <div class="row" id="lengthVideo">
        </div>
    </div>
    <div class="line-hr" style="margin-top: 30px;"></div>
    <div class="container link">
        <div class="row" id="links">
        </div>
    </div>
    @include('Common.RegLogin')
@stop
@section('script')
    <script src="/js/indexAjax.js?v0.1"></script>
@stop