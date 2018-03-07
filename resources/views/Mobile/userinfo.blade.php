@extends('Common.Mobile')
@section('content')
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">E-Mail</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="email" id="email" value="{{ $user['username'] }}" placeholder="请输入邮箱">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">新密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="password" id="newpwd" placeholder="如果不修改密码请勿填写">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">确认密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="password" id="newpwdq" placeholder="如果不修改密码请勿填写">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="password" id="pwd" placeholder="请输入原始密码进行确认">
            </div>
        </div>
    </div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary background-common" href="javascript:" id="showTooltips">提交</a>
    </div>
@stop
@section('script')
<script type="application/javascript" src="/dist/js/chang-user.js?v0.1"></script>
@stop