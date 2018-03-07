<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="{{ Request::getPathInfo() == '/member' ? 'active' : ''}}"><a href="/member">會員資料 <span class="sr-only">(current)</span></a></li>
        <li class="{{ Request::getPathInfo() == '/member/vip' ? 'active' : ''}}"><a href="/member/vip">升級VIP</a></li>
        <li><a href="/member/logout">退出</a></li>
    </ul>
</div>