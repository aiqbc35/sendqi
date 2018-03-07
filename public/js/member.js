window.onload = function(){
    email = '';
    pwd = '';
    newpwd = '';
    newpasswd = '';
    oldpwd = '';
    token = $('meta[name="csrf-token"]').attr('content');

    $("#newemail").blur(function()
    {
        email = $(this).val();
        if (checkEmail(email) == false) {
            layer.tips('请输入合法的邮箱', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            email = '';
            return;
        }

    });

    $("#updatepwd").blur(function()
    {
        pwd = $(this).val();

        if (pwd.length < 6){
            layer.tips('密码不能少于6位', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            pwd = '';
            return;
        }
    });

    $("#updatebtn").click(function()
    {
        if (email == '') {
            layer.msg('请输入正确的邮箱');
            return;
        }
        if (pwd == '') {
            layer.msg('密码最少为6位');
            return;
        }
        $.post("/Api/updateEmail", { email: email, pwd: pwd,'_token':token },function(data){
                  layer.msg(data.message);
                  if (data.code == 'success') {
                     $("#email_cont").text(email);
                     $("#updateEmailModal").modal('hide');
                  }
         });
    });

    $("#newpwd").blur(function()
    {
        newpwd = $(this).val();
        if (newpwd.length < 6) {
            layer.tips('密码不能少于6位', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            return;
        }
    });

    $("#newpasswd").blur(function()
    {
        newpasswd = $(this).val();
        if (newpasswd.length < 6) {
            layer.tips('密码不能少于6位', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            return;
        }
        if (newpasswd != newpwd) {
            layer.tips('两次密码不一致', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            return;
        }
    });

    $("#oldpwd").blur(function()
    {
        oldpwd = $(this).val();
        if (newpwd.length < 6) {
            layer.tips('密码不能少于6位', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            return;
        }
    });

    $("#update_pwd_btn").click(function()
    {
        if (oldpwd.length < 6 || newpwd < 6) {
            layer.msg('密码不能少于6位');
            return;
        }
        if (newpwd != newpasswd) {
            layer.msg('两次密码不一致');
            return;
        }

        $.post("/Api/updatePassword", { oldpwd: oldpwd, newpwd: newpwd,newpasswd:newpasswd,'_token':token },function(data){
            layer.msg(data.message);
            if (data.code == 'success') {
                $("#updatePasswdModal").modal('hide');
            }
         });
    });

}