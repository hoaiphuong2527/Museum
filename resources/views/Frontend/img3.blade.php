@extends('Frontend.masterpage.masterpage')
@section('content')
<section class="body-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/10.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img3.name1')}} </h3>
                            <p class="description height-equal">
                                {{trans('img3.des1')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/audio.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/11.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img3.name2')}}</h3>
                            <p class="description height-equal">
                                {{trans('img3.des2')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/audio.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/13.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img3.name3')}}</h3>
                            <p class="description height-equal">
                                {{trans('img3.des3')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/audio.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <iframe width="100%" height="460px" src="https://www.youtube.com/embed/PWv7gvfk9JI" frameborder="0" allowfullscreen></iframe>
                            <h3 class="title-description">{{trans('img3.namevideo')}}</h3>
                            <p class="description height-equal">
                                {{trans('img3.desvideo')}}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <p class="cart_navigation clearfix">
                <a href="{{ URL::asset('/homepage')}}" class="btn btn-default standard-checkout btn-md icon-right" title="Proceed to checkout" style="">
                    <span>{{trans('content.home')}}</span>
                </a>
                <a href="{{ URL::asset('/list3')}}" class="btn btn-default icon-left" title="Continue shopping">
                    <span>{{trans('content.back')}}</span>
                </a>
            </p>
        </section>
@endsection