$(document).on('ajaxBeforeSend', function(e, xhr, options){
    $('#loadingToast').fadeIn(100);
});
$(document).on('ajaxComplete', function(e, xhr, options){
    $('#loadingToast').fadeOut(100);
});

function emptyData()
{
    var _html = '<div class="weui-loadmore weui-loadmore_line"><span class="weui-loadmore__tips">暂无数据</span></div>';
    console.log(123);
     return _html;
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
function createVideoListHtml(data)
{
    _html = '';
    if (data.length == 0) {
        return emptyData();
    }
    $.each(data,function(k,v){
        _html += '<div class="weui-flex"><div class="weui-flex__item"><div class="placeholder"><div class="weui-form-preview home-img-div index-list-box"><div class="weui-form-preview__bd padding-2"><div class="weui-form-preview__item "><a href="/mobile/view?id='+ v.id +'"><img src="'+v.thumb+'" alt="'+v.title+'" class="video-img"><span class="video-title">'+subString(v.title,30,1)+'</span><i class="ico-paly-class ico-paly"></i></a></div></div><div class="weui-form-preview__ft"><div class="weui-form-preview__btn weui-form-preview__btn_default"><i class="ico-class ico-class-hit"></i><span>'+v.hit+'</span></div><div class="weui-form-preview__btn weui-form-preview__btn_primary"><i class="ico-class ico-class-date"></i><span>'+v.adddate+'</span></div></div></div></div></div></div>';
    });
    return _html;
}

/**
 * 页面总数
 * @param totalVideo  总数量
 * @param limit 页面视频数
 * @returns {number|*}
 */
function pageTotal(totalVideo,limit)
{
    var number = parseInt(limit);

    total = parseInt(totalVideo);

    if (total <= number) {
        $("#page-view").hide();
        return;
    }

    page_number = total / number;

    totalPage = Math.ceil(page_number);
    return totalPage;
}

/**
 * 分页数页
 * @param totalPage 总数
 * @param page 当前页面
 */
function pageNumber(totalPage,page) {

    _html = '';

    for (i=0;i<totalPage;i++) {

        page_number_view = i + 1;

        if ( i == page) {
            _html += '<option selected="" value="'+ i +'">第'+ page_number_view +'页</option>';
        }else{
            _html += '<option value="'+ i +'">第'+ page_number_view +'页</option>';
        }

    }

    $("#page-style").html(_html);

}
function alert1(data)
{
    var _html = '<div id="toast" style="opacity: 1;"><div class="weui-mask_transparent"></div><div class="weui-toast"><p class="weui-toast__content">'+data+'</p></div></div>';
    $("body").append(_html);
    setTimeout(function(){
        $("#toast").remove();
    },3000);
}
function upPage(url,page)
{
    page = parseInt(page);

    if (page <= 0) {
        alert1('已是第一页');
        return;
    }
    window.location.href = url + '?page=' + (page - 1);
    return;
}
function downPage(url,page) {
    page = parseInt(page) + 1;

    if (page == totalPage) {
        alert1('已是第后一页');
        return;
    }
    window.location.href = url + '?page=' + page;
    return;
}