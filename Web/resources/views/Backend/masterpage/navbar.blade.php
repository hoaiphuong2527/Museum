<?php
    $paramater = Request::segment(1);
    $view = Request::segment(2);
    use App\Utils\SessionManager;
    $currentLogin = SessionManager::getLoginInfo();

?>
<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if($view == 'users')
                <a class="navbar-brand" href="#">Quản trị viên</a>
            @elseif($view == 'story_item')
                <a class="navbar-brand" href="#">Bối cảnh</a>
                @elseif($view == 'code')
                <a class="navbar-brand" href="#">Mã đăng nhập</a>
            @else
                <a class="navbar-brand" href="#">Trang chủ</a>
            @endif
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                   <a href="{{ URL::asset('/admin/users/detail/'.$currentLogin->user_id)}}">
                       Tài khoản của bạn
                    </a>
                </li>
                <li>
                    <a href="{{ URL::asset('/logout')}}">
                        Đăng xuất
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>