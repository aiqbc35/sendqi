window.onload = function(){

    var video_id = getRequest();

    if (video_id.id == '' || video_id.id == 0) {
        layer.msg('请选择视频');
        window.location.href = '/';
        return;
    }

    $.get("/Api/getVideo", { id: video_id.id}, function(e){
        if (e.code == 'success') {
            $("#example-video").attr('poster',e.data.thumb);
            $("#videourl").attr('src',e.data.video);
            $(".view-play-title").text(e.data.title);
            var player = videojs('example-video');
        }else{
            layer.alert(e.message, {
                skin: 'layui-layer-lan'
                ,closeBtn: 0
                ,anim: 2 //动画类型
            });
        }
    },'json');

    $.get("/Api/getService", { name: "John", time: "2pm" }, function(e){
        if (e) {
            if (e.data != '') {
                _html = serviceFormLine(e.data);
                $(".line-list").html(_html);
            }
        }
    },'json');


    $.get("/Api/getRandVideo", { name: "John", time: "2pm" }, function(e){
            _html = randVideoForm(e.data);
            $("#rand_video").html(_html);
    },'json');

    function randVideoForm(data)
    {
       _html = '';

       $.each(data,function(k,v){
           if (v.title  == '') {
               return createEmptyDataHtml();
           }
           _html += '<div class="col-md-3">\n' +
               '                <div class="thumbnail">\n' +
               '                    <a href=""><img src="'+v.thumb+'" alt="..." class="img-responsive"></a>\n' +
               '                    <div class="caption">\n' +
               '                        <a href="/view?id='+v.id+'"><h3>'+subString(v.title,16,1)+'</h3></a>\n' +
               '                        <div class="ico">\n' +
               '                            <i class="icon-play"></i><span class="play-data">'+v.hit+'</span>\n' +
               '                            <i class="icon-update posit-right"></i><span class="update-date">'+v.adddate+'</span>\n' +
               '                        </div>\n' +
               '                    </div>\n' +
               '                </div>\n' +
               '            </div>';

       });
        return _html;
    }

    function serviceFormLine(data)
    {
        _html = '';

        $.each(data,function(k,v){
            _html += '<button type="button" class="btn btn-blue btn-lg margin-top-20 click_to_service" data-vid="'+v.id+'">'+ v.name+'</button>';
        });
        return _html;
    }

    $(document).on('click',".click_to_service",function()
    {
        id = $(this).data('vid');
        if (id == ''){
            layer.msg('请选择有效线路');
            return;
        }

        $.get("/Api/changeLine", { id: id }, function(data){
                 layer.msg(data.message);
                  if(data.code == 'success'){
                      window.location.reload();
                  }
        },'json');


    })

}