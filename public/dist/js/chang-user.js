$(".weui-btn").click(function(){
    email = $("#email").val();
    newpwd = $("#newpwd").val();
    newpwdq = $("#newpwdq").val();
    pwd = $("#pwd").val();
    token = $('meta[name="csrf-token"]').attr('content');

    if (pwd.length < 6) {
        alert1('密码不能少于6位');
        return;
    }
    ifEmail = checkEmail(email);

    if (ifEmail == false) {
        alert1('邮箱格式不正确');
        return;
    }

    if (newpwd.length > 0) {

        if (newpwd.length < 6) {
            alert1('新密码不能少于6位');
            return;
        }

        if (newpwd != newpwdq) {
            alert1('两次密码不一致');
            return;
        }

        $.post("/Api/updatePassword", { oldpwd: pwd, newpwd: newpwd,newpasswd:newpwdq,'_token':token },function(data){
            alert1(data.message);
        });

    }
    $.post("/Api/updateEmail", { email: email, pwd: pwd,'_token':token },function(data){
        alert1(data.message);
        if (data.code == 'success') {
            $("#email").val(email);
        }
    });

});
