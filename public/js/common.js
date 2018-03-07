$(document).on("ajaxStart ajaxStop",function(){
    $('#loadingModal').modal('toggle')
});
function createEmptyDataHtml()
{
    _html = '<ul class="list-group"><li class="list-group-item text-center">暂无数据</li></ul>';
    return _html;
}

var regInput = function(){
    email = '';
    pwd = '';
    pwdq = '';
    token = $('meta[name="csrf-token"]').attr('content');
    $("#regEmail").blur(function()
    {
        email = $(this).val();
        if (!checkEmail(email)) {
            btnDisabled();
            layer.tips('请输入合法的邮箱', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            email = '';
            return;
        }
        btnAction();
    });
    $("#regpwd").blur(function()
    {
        pwd = $(this).val();
        if (pwd.length < 6){
            layer.tips('密码不能少于6位', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            btnDisabled();
            pwd = '';
            return;
        }
        btnAction();
    });
    $("#regpwd2").blur(function()
    {
        pwdq = $(this).val();
        if (pwdq != pwd) {
            layer.tips('两次密码不一致', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            btnDisabled();
            pwdq = '';
            return;
        }
        btnAction();
    });
    $("#regBtn").click(function()
    {
        if (email == '') {
            layer.msg('请输入正确的邮箱');
            return;
        }
        if (pwd == '') {
            layer.msg('请输入密码，最少6位！');
            return;
        }
        if (pwdq  == ''){
            layer.msg('请检查两次密码是否一致');
            return;
        }
        $.post("/Api/reg", { email: email, pwd: pwd,pwdq:pwdq,'_token':token,type:'pc'},function(data){
            layer.msg(data.message);
                  if (data.code == 'success') {
                    window.location.href = data.data.url;
                  }
         });

    });
    function btnDisabled(){
        $("#regBtn").attr('disabled','disabled');
    }
    function btnAction()
    {
        $("#regBtn").removeAttr('disabled');
    }
};
regInput();

var LoginInput = function(){
    email = '';
    pwd = '';
    token = $('meta[name="csrf-token"]').attr('content');
    $("#loginemail").blur(function()
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

    $("#loginpwd").blur(function()
    {
        pwd = $(this).val();
        if (pwd.length < 6) {
            layer.tips('密码不能少于6位', $(this), {
                tips: [1, '#FF3030'] //还可配置颜色
            });
            pwd = '';
            return;
        }
    });
    $("#loginbtn").click(function()
    {
        if (email == '') {
            layer.msg('请输入正确的邮箱');
            return;
        }
        if (pwd == '') {
            layer.msg('密码不能少于6位');
            return;
        }
        $.post("/Api/login", { email: email, pwd: pwd,'_token':token },function(e){
            layer.msg(e.message);
            if (e.code == 'success') {
                window.location.href = e.data.url;
            }
         });
    });
};
LoginInput();

/**
 * 创建视频列表
 * @param data  视频数据
 * @param link  图片服务器
 * @returns {string}
 */
function crateVideoHtml(data)
{
    var _html = "";

    if (data.length == 0) {
        return createEmptyDataHtml();
    }

    $.each(data,function(k,e){

        _html += '<div class="col-md-3"><div class="thumbnail">\n' +
            '<a href="/view?id='+ e.id +'"><img src="'+ e.thumb +'" alt="'+e.title+'" class="img-responsive"></a><div class="caption">\n' +
            '<a href="/view?id='+ e.id +'"><h3>'+ subString(e.title,16,1) +'</h3></a>\n' +
            '<div class="ico">\n' +
            '<i class="icon-play"></i><span class="play-data">'+ e.hit +'</span>\n' +
            '<i class="icon-update posit-right"></i><span class="update-date">'+ e.adddate +'</span>\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>';
    });
    return _html;
}

/**
 * 分页总数
 * @param total
 * @returns {number|*}
 */
function pageTotal(total)
{
    limit = 20;
    total = parseInt(total);

    page = total / limit;

    totalPage = Math.ceil(page);

    return totalPage;
}

/**
 * 分页处理
 * @param totalPage 总页数
 * @param page 当前页数
 * @param pageUrl 分页链接地址
 */
function pageStyle(totalPage,page,pageUrl)
{
    var pageHtml = $(".pager > li");
    totalPage = totalPage - 1;
    page = parseInt(page);
    if (totalPage <= 1) {
        $("#page-js").remove();
    }else if(page > totalPage){
        layer.msg('不存在的分页');
        $("#page-js").remove();
    } else{
        nextPage = page + 1;
        upPage = page - 1;

        pageHtml['1'].children[0]['href'] = pageUrl + '?page=' + upPage;
        pageHtml['2'].children[0]['href'] = pageUrl + '?page=' + nextPage;
        pageHtml['3'].children[0]['href'] = pageUrl + '?page=' + totalPage;
        if (page == 0) {
            pageHtml['0'].className = 'disabled';
            pageHtml['1'].className = 'disabled';
            pageHtml['2'].children[0]['href'] = pageUrl + '?page=' + nextPage;
            pageHtml['0'].children[0]['href'] = 'javascript:;';
            pageHtml['1'].children[0]['href'] = 'javascript:;';
            pageHtml['3'].children[0]['href'] = pageUrl + '?page=' + totalPage;
        }
        if (totalPage == page) {
            pageHtml['2'].className = 'disabled';
            pageHtml['3'].className = 'disabled';
            pageHtml['0'].children[0]['href'] = pageUrl;
            pageHtml['1'].children[0]['href'] = pageUrl + '?page=' + upPage;
            pageHtml['2'].children[0]['href'] = 'javascript:;';
            pageHtml['3'].children[0]['href'] = 'javascript:;';
        }

    }

}
/**
 * 获取URL信息
 * @returns {Object}
 */
function getRequest()
{
    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    return theRequest;
}

/**
 * 邮箱验证
 * @param email
 * @returns {boolean}正确TRUE 错误FALSE
 */
function checkEmail(email)
{
    var regex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (regex.test(email)) {
        return true;
    }else{
        return false;
    }
}

/**
 * 截取中文字符
 * @param str  字符串
 * @param len 长度
 * @param hasDot [true]增加... false 不加
 * @returns {string}
 */
function subString(str, len, hasDot)
{
    var newLength = 0;
    var newStr = "";
    var chineseRegex = /[^\x00-\xff]/g;
    var singleChar = "";
    var strLength = str.replace(chineseRegex,"**").length;
    for(var i = 0;i < strLength;i++)
    {
        singleChar = str.charAt(i).toString();
        if(singleChar.match(chineseRegex) != null)
        {
            newLength += 2;
        }
        else
        {
            newLength++;
        }
        if(newLength > len)
        {
            break;
        }
        newStr += singleChar;
    }

    if(hasDot && strLength > len)
    {
        newStr += "...";
    }
    return newStr;
}


