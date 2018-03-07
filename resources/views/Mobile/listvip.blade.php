@extends('Common.Mobile')
@section('content')
    <div id="list">
    </div>

    <div class="weui-flex margin-top-13" id="page-view">
        <div class="weui-flex__item">
            <div class="placeholder padding-left-30">
                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_primary background-common" id="page-up">上一页</a>
            </div>
        </div>
        <div class="weui-flex__item">
            <div class="placeholder">
                <div class="weui-cell weui-cell_select page-total">
                    <div class="weui-cell__bd">
                        <select class="weui-select" name="select1" id="page-style">
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-flex__item">
            <div class="placeholder padding-left-30">
                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_primary background-common" id="page-down">下一页</a>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="application/javascript" src="/dist/js/list-vip.js?v0.1"></script>
@stop