@extends('Common.Home')
@section('css')
    <link href="https://v3.bootcss.com/examples/dashboard/dashboard.css" rel="stylesheet">
@stop
@section('content')
    <div class="container dashboard">
        <div class="row">
            @include('Home.memberMune')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">VIP</h1>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">激活会员</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-inline">
                                <div class="form-group form-group-lg">
                                    <label for="exampleInputAmount" class="sr-only">Amount (in dollars)</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Code</div>
                                        <input type="text" id="exampleInputAmount" placeholder="请输入激活码" class="form-control">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-blue-default btn-lg" id="put_code">激活VIP会员</button>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">购买激活码</h3>
                        </div>
                        <div class="panel-body">
                            <label class="radio-inline text-primary">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="68"> 1月/68元
                            </label>
                            <label class="radio-inline text-primary">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="120"> 半年/120元
                            </label>
                            <label class="radio-inline text-primary">
                                <input type="radio" checked name="inlineRadioOptions" id="inlineRadio3" value="180"> 1年/180元
                            </label>

                            <button type="button" class="btn btn-blue-default" style="margin-left: 50px;" id="shop_code">购买</button>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            激活步骤
                        </div>
                        <div class="panel-body">
                            <p>1、在"购买激活码"中选择激活码类型，点击购买，之后会跳转至新页面进行支付。</p>
                            <p>2、支付后会显示激活码，拿到激活码后返回本页面</p>
                            <p>3、在最上面的"激活会员"输入激活码，点击"激活VIP会员"</p>
                            <p>4、观赏影片</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
<script type="application/javascript" src="/js/vip.js?v0.3"></script>
@stop