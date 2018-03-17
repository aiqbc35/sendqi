window.onload = function(){
    var shopurl18 = 'http://www.18kk.cn/buy/c0167d1ca20fc225.htm';
    var shopurl68 = 'http://www.18kk.cn/buy/b977b5328f95506e.htm';
    var shopurl120 = 'http://www.18kk.cn/buy/af086cda68dc2fce.htm';
    var shopurl180 = 'http://www.18kk.cn/buy/39016cfefcba3fd8.htm';



    $("#shop_code").click(function()
    {
        shopId = $("input[name='inlineRadioOptions']:checked").val();

        switch (shopId){
            case '18':
                shopUrl = shopurl18;
                break;
            case '68':
                shopUrl = shopurl68;
                break;
            case '120':
                shopUrl = shopurl120;
                break;
            case '180':
                shopUrl = shopurl180;
                break;
            default:
                shopUrl = shopurl180;
        }
        window.open(shopUrl);
    });

    $("#put_code").click(function()
    {
        code = $("#exampleInputAmount").val();
        token = $('meta[name="csrf-token"]').attr('content');
        if (code == '') {
            layer.msg('激活码不能为空');
            return;
        }

        $.post("/Api/actionCode", { code: code, '_token': token },function(data){
                  layer.msg(data.message);
         });


    });

}