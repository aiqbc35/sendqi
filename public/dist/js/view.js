$(function(){
    var video_id = getRequest();

    if (video_id.id == '' || video_id.id == 0) {
        alert1('请选择视频');
        window.location.href = '/mobile/index';
        return;
    }
    $.get("/Api/getVideo", { id: video_id.id}, function(e){
        if (e.code == 'success') {
            $("#example-video").attr('poster',e.data.thumb);
            $("#videourl").attr('src',e.data.video);
            $(".title span").text(e.data.title);
            var player = videojs('example-video');
        }else{
            alert1(e.message);
        }
    },'json');

    $.get("/Api/getService", { name: "John", time: "2pm" }, function(e){
        if (e) {
            if (e.data != '') {
                _html = serviceFormLine(e.data);
                $("#service-line").html(_html);
            }
        }
    },'json');

    $.get("/Api/getRandVideo", { name: "John", time: "2pm" }, function(e){
        _html = createIndexHtml(e.data);
        $("#long").html(_html);
    },'json');

    $(document).on('click','.weui-btn_mini',function(){
        id = $(this).data('vid');
        if (id == ''){
            alert1('请选择有效线路');
            return;
        }

        $.get("/Api/changeLine", { id: id }, function(data){
            alert1(data.message);
            if(data.code == 'success'){
                window.location.reload();
            }
        },'json');
    });

});
function serviceFormLine(data) {
    _html = '';
    $.each(data,function(k,v){
        _html += '<a href="javascript:;" data-vid="'+v.id+'" class="weui-btn weui-btn_mini weui-btn_primary background-common">'+v.name+'</a>';
    });
    return _html;
}
function createIndexHtml(data)
{
    var head = '<div class="weui-flex margin-bottom-9">';
    var footer = '</div>';
    _html = '';
    return_html = '';

    if (data.length == 0) {
        return_html = emptyData();
        return return_html;
    }

    $.each(data,function(k,v){
        k++;
        _html = '<div class="weui-flex__item index-list-left-right-padding"><div class="placeholder"><div class="weui-form-preview home-img-div index-list-box"><div class="weui-form-preview__bd padding-2"><div class="weui-form-preview__item "><a href="/mobile/view?id='+v.id+'"><img src="'+v.thumb+'" alt="'+v.title+'"></a><span class="video-title">'+subString(v.title,16,1)+'</span></div></div><div class="weui-form-preview__ft"><div class="weui-form-preview__btn weui-form-preview__btn_default"><i class="ico-class ico-class-hit"></i><span>'+v.hit+'</span></div><div class="weui-form-preview__btn weui-form-preview__btn_primary"><i class="ico-class ico-class-date"></i><span>'+v.adddate+'</span></div></div></div></div></div>';

        if (!(k%2)) {
            return_html += _html + footer;
        }else{
            return_html += head + _html;
        }
    });
    return return_html;
}