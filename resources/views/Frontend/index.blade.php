@extends('Frontend.masterpage.masterpage')
@section('content')
<!-- Main-->
<div class="clearfix"></div>
<section class="body-content">
    <div class="container">
        <div class="row">
        <!-- <script type="text/javascript" src="{{ URL::asset('frontend/js/jquery.lazyload.js')}}"></script>
            <div class="r_col" style="text-align:center">
                <p><span style="font-size: 20px; color: #333366;width:100%">Sơ đồ Bảo tàng Chứng tích Chiến tranh</span> </p>
                <p>
                <object width="620" height="750" data="{{ URL::asset('frontend/images/wrm_map.swf')}} " type="application/x-shockwave-flash"><param name="data" value="{{ URL::asset('frontend/images/wrm_map.swf')}}" />
                <param name="wmode" value="transparent" />
                <param name="src" value="{{ URL::asset('frontend/images/wrm_map.swf')}}" />
                </object>
                </p>
            </div> -->
            <div class="floor">
                <img src="{{ URL::asset('frontend/images/floor3.JPG')}}" alt="Avatar" class="image" style="width:100%">
                <div class="middle">
                    <div class="text">
                        <h1>{{ trans('content.floor',['num'=> 3])}}</h1>
                        <p class="des">{{ trans('content.des_floor3')}}</p>
                        <p><a href="{{ URL::asset('/list3')}}" class="read-more">{{ trans('content.view')}}</a></p>
                    </div>
                </div>
            </div>
            <div class="floor">
                <img src="{{ URL::asset('frontend/images/floor2.jpg')}}" alt="Avatar" class="image" style="width:100%">
                <div class="middle">
                    <div class="text">
                        <h1>{{ trans('content.floor',['num'=> 2])}}</h1>
                        <p class="des">{{ trans('content.des_floor2')}}</p>
                        <p><a href="{{ URL::asset('/list2')}}" class="read-more">{{ trans('content.view')}}</a></p>
                    </div>
                </div>
            </div>
            <div class="floor">
                <img src="{{ URL::asset('frontend/images/floor1.jpg')}}" alt="Avatar" class="image" style="width:100%">
                <div class="middle">
                    <div class="text">
                        <h1>{{ trans('content.floor',['num'=> 1])}}</h1>
                        <p class="des">{{ trans('content.des_floor1')}}</p>
                        <p><a href="{{ URL::asset('/list1')}}" class="read-more">{{ trans('content.view')}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Main -->
@endsection