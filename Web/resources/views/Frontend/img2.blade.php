@extends('Frontend.masterpage.masterpage')
@section('content')
<section class="body-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/img2')}}"><img src="{{ URL::asset('frontend/images/4.jpg') }}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img2.name1')}}</h3>
                            <p class="description height-equal">
                                {{trans('img2.des1')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chedolaotu.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/5.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img2.name2')}} </h3>
                            <p class="description height-equal">
                                {{trans('img2.des2')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chedolaotu.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/6.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img2.name3')}}</h3>
                            <p class="description height-equal">
                                {{trans('img2.des3')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chedolaotu.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/7.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img2.name4')}} </h3>
                            <p class="description height-equal">
                                {{trans('img2.des4')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chedolaotu.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><a href="{{ URL::asset('/image')}}"><img src="{{ URL::asset('frontend/images/8.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description">{{trans('img2.name5')}} </h3>
                            <p class="description height-equal">
                                {{trans('img2.des5')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chedolaotu.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <iframe width="100%" height="460px" src="https://www.youtube.com/embed/11qk4iEOpBY" frameborder="0" allowfullscreen></iframe>
                            <h3 class="title-description">{{trans('img2.namevideo')}}</h3>
                            <p class="description height-equal">
                                {{trans('img2.desvideo')}}
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