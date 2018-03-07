window.onload = function(){
    $.get("/Api/getHome", function(e){
             if (e.code == 'ERROR') {
                 layer.alert(e.message, {icon: 6});
             }else{
                 freeVideoHtml = crateVideoHtml(e.data.freeVideo);
                 vipVideoHtml = crateVideoHtml(e.data.vipVideo);

                 lengthVideo = crateVideoHtml(e.data.lengthVideo);
                 $("#freevideo").html(freeVideoHtml);
                 $("#vipvideo").html(vipVideoHtml);
                 $("#lengthVideo").html(lengthVideo);
                links = createLinks(e.data.links);
                $("#links").html(links);
             }
    },'json');

    function createLinks(data)
    {
        var linkHtml = '';

        $.each(data,function(k,e){
            if (e.title  == '') {
                return createEmptyDataHtml();
            }
            linkHtml += '<a href="'+ e.link +'" class="col-md-1 link-padding">'+ e.title +'</a>';

        });
        return linkHtml;
    }

}