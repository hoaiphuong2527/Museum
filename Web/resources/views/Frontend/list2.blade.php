@extends('Frontend.masterpage.masterpage')
@section('content')

<section class="body-content">
            <div class="container">
                <div class="row">
                <!-- Box -->
                <div class="box">
                        <div class="title-list">Sơ đồ tầng 2</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/tang2.png')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/image')}}"></a></h2>
                                <p>
                                   
                                    <span>{{trans('content.d5')}}</span><br>
                                    <span>{{trans('content.d6')}}</span><br>
                                    <span>{{trans('content.d7')}}</span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list2.room1')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/demo')}}"><img src="{{ URL::asset('frontend/images/h1.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/demo')}}">{{ trans('list2.name1')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list2.des1')}}
                                    <span><a href="{{ URL::asset('/demo')}}">{{ trans('content.view')}}</a></span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list2.room2')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/img2')}}"><img src="{{ URL::asset('frontend/images/4.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/img2')}}">{{ trans('list2.name2')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list2.des2')}}
                                    <span><a href="{{ URL::asset('/img2')}}">{{ trans('content.view')}}</a></span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                </div>
                <div class="clear"></div>
            </div>
            <div class="container">
                <div class="paging">
                    <ul>
                        <li><a href=""><</a>
                        </li>
                        <li><a class="active" href="">1</a>
                        </li>
                        <li><a href="">2</a>
                        </li>
                        <li><a href="">...</a>
                        </li>
                        <li><a href="">5</a>
                        </li>
                        <li><a href="">></a></li>
                    </ul>
                </div>
            </div>
        </section>

     
        @endsection