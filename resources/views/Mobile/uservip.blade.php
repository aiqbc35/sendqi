@extends('Common.Mobile')
@section('content')
    <div class="weui-cells__title" style="margin-top: 1em;">激活会员</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">激活码</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" id="code" placeholder="请输入激活码">
            </div>
            <div class="weui-cell__ft">
                <button class="weui-vcode-btn background-common">激活</button>
            </div>
        </div>
    </div>
    <div class="weui-cells__title" style="margin-top: 1em;">激活码购买</div>
    <div class="weui-cells weui-cells_radio" >
        <label class="weui-cell weui-check__label" for="x11">
            <div class="weui-cell__bd">
                <p>68元/月</p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" name="radio1" id="x11" value="68">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x12">

            <div class="weui-cell__bd">
                <p>120元/半年</p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" name="radio1" class="weui-check" id="x12" value="120">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x13">

            <div class="weui-cell__bd">
                <p>180元/年</p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" name="radio1" class="weui-check" id="x13" checked="checked" value="180">
                <span class="weui-icon-checked"></span>
            </div>
        </label>

    </div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary background-common" href="javascript:" id="showTooltips">购买</a>
    </div>
    <div class="weui-cells__title" style="margin-top: 1em;">操作步骤</div>
    <article class="weui-article vip-text">
        <section>
            <p>1、在"激活码购买"选择激活码类型点击购买。</p>
            <p>2、得到激活码后，在"激活会员"输入激活码并点击后面的激活按钮激活会员。</p>
            <p>3、尽情的观看视频吧。</p>
        </section>
    </article>
@stop
@section('script')
<script type="application/javascript">

    var shopurl68 = 'http://www.yunfaka.com/product/F38AB02C60BC46F3';
    var shopurl120 = 'http://www.yunfaka.com/product/BB16692E51CE8684';
    var shopurl180 = 'http://www.yunfaka.com/product/A817AD6FC36EEFE6';

    shopUrl = '';

    $("#showTooltips").click(function(){
        shopId = $("input[name='radio1']:checked").val();
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

    $(".weui-vcode-btn").click(function(){
        code = $("#code").val();
        token = $('meta[name="csrf-token"]').attr('content');
        if (code == '') {
            alert1('激活码不能为空');
            return;
        }
        $.post("/Api/actionCode", { code: code, '_token': token },function(data){
            alert1(data.message);
        });
    });
</script>
@stop