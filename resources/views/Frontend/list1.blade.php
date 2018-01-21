@extends('Frontend.masterpage.masterpage')
@section('content')

<section class="body-content">
            <div class="container">
                <div class="row">
                    <div class="box">

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                <!-- Box -->
                <div class="box">
                        <div class="title-list">Sơ đồ tầng 1</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/tang1.png')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/image')}}"></a></h2>
                                <p class="box-des">
                                   
                                    <span>{{trans('content.d1')}}</span><br>
                                    <span>{{trans('content.d2')}}</span><br>
                                    <span>{{trans('content.d3')}}</span><br>
                                    <span>{{trans('content.d4')}}</span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list1.room1')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/tbtx_5_1.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/image')}}">{{ trans('list1.name1')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list1.des1')}}
                                    <span><a href="{{ URL::asset('/image')}}">{{ trans('content.view')}}</a></span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list1.room2')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/floor1.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/image')}}">{{ trans('list1.name2')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list1.des2')}}
                                    <span><a href="{{ URL::asset('/image')}}">{{ trans('content.view')}}</a></span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list1.room3')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/tbtx_3_1.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/image')}}">{{ trans('list1.name3')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list1.des3')}}
                                    <span><a href="{{ URL::asset('/image')}}">{{ trans('content.view')}}</a></span>
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