window.onload = function(){
    var page = getRequest().page ? getRequest().page : 0;

    $.get("Api/getVideoList", { type: 0, page: page }, function(e){
            if (e.code == 'success') {
                totalPage = pageTotal(e.data.count);
                pageStyle(totalPage,page,'/list');
                _html = crateVideoHtml(e.data.list);
            }else{
                _html = createEmptyDataHtml();
            }
            $("#video-free").html(_html);
    },'json');
}