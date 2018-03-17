<div class="row">
    <div class="col-md-12">
        @if(Session()->has('USER_INFO_CACHE'))
            <a href="/member/vip">
                @else
                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal">
                        @endif
                        <img src="/demo/list.gif" alt="" style="width: 100%;">
                    </a>
    </div>
</div>