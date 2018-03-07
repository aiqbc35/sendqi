@extends('Common.Home')
@section('css')
    <link href="https://v3.bootcss.com/examples/dashboard/dashboard.css" rel="stylesheet">
@stop
@section('content')
    <div class="container dashboard">
        <div class="row">
            @include('Home.memberMune')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">會員資料</h1>

                <div class="row placeholders">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <colgroup>
                                <col class="col-xs-1">
                                <col class="col-xs-7">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row">
                                    邮箱
                                </th>
                                <td>
                                    <span id="email_cont">{{ $user['username'] }}</span>
                                    <button type="button" class="btn btn-blue-default btn-sm pull-right" data-target="#updateEmailModal" data-toggle="modal">修改</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    VIP
                                </th>
                                <td>@if($user['type'] == 1)是@else否@endif
                                    <a class="btn btn-blue-default btn-sm pull-right" href="/member/vip">升级</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    VIP到期时间
                                </th>
                                <td>@if($user['type'] == 1){{ date('Y-m-d',$user['vipstoptime']) }}@endif
                                    <a class="btn btn-blue-default btn-sm pull-right" href="/member/vip">续费</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    密码
                                </th>
                                <td>******
                                    <button type="button" class="btn btn-blue-default btn-sm pull-right" data-target="#updatePasswdModal" data-toggle="modal">修改</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="updateEmailModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel1">修改邮箱</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">新郵箱</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="newemail" placeholder="請填寫郵箱地址">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密碼</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="updatepwd" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" id="updatebtn" class="btn btn-default">修改</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="updatePasswdModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel1">修改密码</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="newpwd" placeholder="请填写新密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="newpasswd" placeholder="请确认新密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密碼</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="oldpwd" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" id="update_pwd_btn" class="btn btn-default">修改</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('script')
<script type="application/javascript" src="/js/member.js?v0.3"></script>
@stop