window.onload = function(){

    var shopurl68 = 'http://www.yunfaka.com/product/F38AB02C60BC46F3';
    var shopurl120 = 'http://www.yunfaka.com/product/BB16692E51CE8684';
    var shopurl180 = 'http://www.yunfaka.com/product/A817AD6FC36EEFE6';



    $("#shop_code").click(function()
    {
        shopId = $("input[name='inlineRadioOptions']:checked").val();

        switch (shopId){
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