window.onload = function(){
    var page = getRequest().page ? getRequest().page : 0;

    $.get("Api/getVideoList", { type: 1, page: page,length:1 }, function(e){
        if (e.code == 'success') {
            totalPage = pageTotal(e.data.count);
            pageStyle(totalPage,page,'/list-long');
            _html = crateVideoHtml(e.data.list);
        }else{
            _html = createEmptyDataHtml();
        }
        $("#video-long").html(_html);
    },'json');

}