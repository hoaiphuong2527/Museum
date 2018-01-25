@extends('Frontend.masterpage.masterpage')
@section('content')

<section class="body-content">
            <div class="container">
                <div class="row">
                <!-- Box -->
                <div class="box">
                        <div class="title-list">Sơ đồ tầng 3</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/tang3.png')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/image')}}"></a></h2>
                                <p class="box-des">
                                    <span>{{trans('content.d8')}}</span><br>
                                    <span>{{trans('content.d9')}}</span><br>
                                    <span>{{trans('content.d10')}}</span><br>
                                    <span>{{trans('content.d11')}}</span><br>
                                    <span>{{trans('content.d12')}}</span><br> 
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list3.room1')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/tbtx_5_1.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/image')}}">{{ trans('list3.name1')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list3.des1')}}
                                    <span><a href="{{ URL::asset('/image')}}">{{ trans('content.view')}}</a></span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list3.room2')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/img2')}}"><img src="{{ URL::asset('frontend/images/tbtx_8_1.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/img2')}}">{{ trans('list3.name2')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list3.des2')}}
                                    <span><a href="{{ URL::asset('/img2')}}">{{ trans('content.view')}}</a></span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list3.room3')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/img3')}}"><img src="{{ URL::asset('frontend/images/tbtx_3_1.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/img3')}}">{{ trans('list3.name3')}}</a></h2>
                                <p class="box-des">
                                    {{ trans('list3.des3')}}
                                    <span><a href="{{ URL::asset('/img3')}}">{{ trans('content.view')}}</a></span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <div class="title-list">{{ trans('list3.room4')}}</div>
                        <div class="news">
                            <div class="news-hot-left"><a href="{{ URL::asset('/img3')}}"><img src="{{ URL::asset('frontend/images/13.jpg')}}"></a></div>
                            <div class="news-hot-right">
                                <h2><a href="{{ URL::asset('/img3')}}">{{ trans('list3.name4')}}</a></h2>
                                <p>
                                    {{ trans('list3.des4')}}
                                    <span><a href="{{ URL::asset('/img3')}}">{{ trans('content.view')}}</a></span>
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