window.onload = function(){

    $.getJSON('/Api/getHome', function(e){

            free_html = createIndexHtml(e.data.freeVideo);
            $("#free").html(free_html);
            vip_html = createIndexHtml(e.data.vipVideo);
            $("#vip").html(vip_html);
            long_html = createIndexHtml(e.data.lengthVideo);

            $("#long").html(long_html);

    })

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
}