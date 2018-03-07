window.onload = function(){
    var page = getRequest().page ? getRequest().page : 0;
    totalPage = 0;
    limit = 0;
    var pageUrl = '/mobile/list-vip';
    $.getJSON('/Api/getVideoList', {type: 1, page: page},function(e){
        totalPage = pageTotal(e.data.count,e.data.limit);
        if (totalPage) {
            pageNumber(totalPage,page);
        }
        _html = createVideoListHtml(e.data.list);
        $("#list").html(_html);
    });
    $("#page-up").click(function(){
        upPage(pageUrl,page);
    });
    $("#page-down").click(function(){
        downPage(pageUrl,page);
    });
    $("#page-style").change(function(){
        var id = $(this).val();
        window.location.href = pageUrl + '?page=' + id;
    });




}