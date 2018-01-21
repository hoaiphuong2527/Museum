<?php
    $paramater = Request::segment(1);
    $view = Request::segment(2);
?>

<div class="sidebar-wrapper">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            Creative Tim
        </a>
    </div>

    <ul class="nav">
        @if($paramater == "admin" && $view == "")
        <li class="active">
            <a href="{{ URL::asset('/admin')}}">
                <i class="pe-7s-graph"></i>
                <p>Trang chủ</p>
            </a>
        </li>
        @else
        <li class="">
            <a href="{{ URL::asset('/admin')}}">
                <i class="pe-7s-graph"></i>
                <p>Trang chủ</p>
            </a>
        </li>
        @endif

        @if($view == "users")
        <li class="active">
            <a href="{{ URL::asset('/admin/users')}}">
                <i class="pe-7s-user"></i>
                <p>Quản trị viên</p>
            </a>
        </li>
        @else 
        <li class="">
                <a href="{{ URL::asset('/admin/users')}}">
                    <i class="pe-7s-user"></i>
                    <p>Quản trị viên</p>
                </a>
            </li>
        @endif

        @if($view == "story_item")
        <li class="active">
            <a href="{{ URL::asset('admin/story_item')}}">
                <i class="pe-7s-photo-gallery"></i>
                <p>Hình ảnh</p>
            </a>
        </li>
        @else
        <li>
            <a href="{{ URL::asset('admin/story_item')}}">
                <i class="pe-7s-photo-gallery"></i>
                <p>Hình ảnh</p>
            </a>
        </li>
        @endif
        @if($view == "stories")
        <li class="active">
            <a href="typography.html">
                <i class="pe-7s-news-paper"></i>
                <p>Câu chuyện</p>
            </a>
        </li>
        @else
        <li>
            <a href="typography.html">
                <i class="pe-7s-news-paper"></i>
                <p>Câu chuyện</p>
            </a>
        </li>
        @endif
        <li>
            <a href="icons.html">
                <i class="pe-7s-science"></i>
                <p>Icons</p>
            </a>
        </li>
        <li>
            <a href="maps.html">
                <i class="pe-7s-map-marker"></i>
                <p>Maps</p>
            </a>
        </li>
        <li>
            <a href="notifications.html">
                <i class="pe-7s-bell"></i>
                <p>Notifications</p>
            </a>
        </li>
        <li class="active-pro">
            <a href="upgrade.html">
                <i class="pe-7s-rocket"></i>
                <p>Upgrade to PRO</p>
            </a>
        </li>
    </ul>
</div>