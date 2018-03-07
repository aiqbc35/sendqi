@extends('Common.Mobile')
@section('content')
    <div class="weui-flex">
        <div class="weui-flex__item padding-top-2">
            <i class="ico-member"></i>
        </div>
    </div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>E-Mail:{{ $user['username'] }}</p>
                @if($user['viptype'] == 1)
                <span class="weui-badge" style="position: absolute;top: 12px;right: 20px;">VIP</span>
                    @endif
            </div>
        </div>
        @if($user['viptype'] == 1)
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>VIP到期时间：{{ date('Y-m-d',$user['vipstoptime']) }}</p>
            </div>
        </div>
        @endif
        <a class="weui-cell weui-cell_access" href="/mobile/member/changUser">
            <div class="weui-cell__hd"><img src="/dist/images/me-info.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
            <div class="weui-cell__bd">
                <p>檔案信息</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="/mobile/member/vip">
            <div class="weui-cell__hd"><img src="/dist/images/vip-info.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
            <div class="weui-cell__bd">
                <p>VIP升级</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary background-common" href="/member/logout" id="showTooltips">退出</a>
    </div>
@stop