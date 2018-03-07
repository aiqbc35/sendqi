@extends('Common.Mobile')
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item padding-top-5">
            <h3 class="reg-title">註冊</h3>
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">E-Mail</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="email" id="email" placeholder="请输入email">
                    </div>
                </div>
                <div class="weui-cell weui-cells_form">
                    <div class="weui-cell__hd">
                        <label class="weui-label">密码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" id="pwd" placeholder="请输入密码">
                    </div>
                </div>
                <div class="weui-cell weui-cells_form">
                    <div class="weui-cell__hd">
                        <label class="weui-label">确认密码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" id="pwdq" placeholder="请再次输入密码">
                    </div>
                </div>
            </div>
            <div class="weui-cells__tips" style="text-align: center;">
                <a href="javascript:;" class="">请填写真实邮箱，当网站无法访问时，我们将第一时间发送最新网址至您注册的邮箱！</a>
            </div>
            <div class="weui-btn-area">
                <a class="weui-btn weui-btn_primary background-common" href="javascript:" id="showTooltips">确定</a>
            </div>
            <div class="weui-cells__tips" style="text-align: center;">
                <a href="/mobile/login" class="line-height-36">已有账号，前往登陆</a>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $("#showTooltips").click(function(event){
            email = $("#email").val();
            pwd = $("#pwd").val();
            pwdq = $("#pwdq").val();
            token = $('meta[name="csrf-token"]').attr('content');

            ifEmail = checkEmail(email);

            if (ifEmail == false) {
                alert1('邮箱格式不正确');
                return;
            }
            if (pwd.length < 6) {
                alert1('密码不能少于6位');
                return;
            }
            if (pwd != pwdq) {
                alert1('两次密码不一致');
                return;
            }
            $.post("/Api/reg", { email: email, pwd: pwd,pwdq:pwdq,'_token':token,type:'mobile'},function(data){
                      alert1(data.message);
                      if (data.code == 'success') {
                          window.location.href = '/mobile/member/index';
                      }
             });
        });
    </script>
@stop