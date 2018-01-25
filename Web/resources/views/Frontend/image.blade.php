@extends('Frontend.masterpage.masterpage')
@section('content')
<section class="body-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/1.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('image.name1')}} </h3>
                            <p class="description height-equal">
                                {{trans('image.des1')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/audio.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/2.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('image.name2')}}</h3>
                            <p class="description height-equal">
                                {{trans('image.des2')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/audio.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/3.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('image.name3')}}</h3>
                            <p class="description height-equal">
                                {{trans('image.des3')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/audio.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <iframe width="100%" height="460px" src="https://www.youtube.com/embed/OB4ty-zfSps" frameborder="0" allowfullscreen></iframe>
                            <h3 class="title-description">{{trans('image.namevideo')}}</h3>
                            <p class="description height-equal">
                                {{trans('image.desvideo')}}
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