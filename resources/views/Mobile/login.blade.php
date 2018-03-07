@extends('Common.Mobile')
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item padding-top-5">
            <h3 class="reg-title">登陸</h3>
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
            </div>

            <div class="weui-btn-area">
                <a class="weui-btn weui-btn_primary background-common" href="javascript:" id="showTooltips">登陸</a>
            </div>
            <div class="weui-cells__tips" style="text-align: center;">
                <a href="/mobile/register" class="line-height-36">還沒有账号，前往註冊</a>
            </div>
        </div>
    </div>
@stop
@section('script')
<script type="application/javascript">
        $("#showTooltips").click(function(){
            email = $("#email").val();
            pwd = $("#pwd").val();
            token = $('meta[name="csrf-token"]').attr('content');

            ifEmail = checkEmail(email);

            if (ifEmail == false) {
                alert1('请输入正确邮箱');
                return;
            }

            if (pwd.length < 6) {
                alert1('请输入密码');
                return;
            }

            $.post("/Api/login", { email: email, pwd: pwd,'_token':token },function(data){
                      alert1(data.message);
                      if (data.code == 'success') {
                          window.location.href = '/mobile/member/index';
                      }
             });

        });
</script>
@stop