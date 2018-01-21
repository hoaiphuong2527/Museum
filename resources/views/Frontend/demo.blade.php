@extends('Frontend.masterpage.masterpage')
@section('content')
<section class="body-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="box">
                            <iframe width="100%" height="460px" src="https://www.youtube.com/embed/LGreLF18O5g" frameborder="0" allowfullscreen></iframe>
                            <h3 class="title-description">{{trans('demo.namevideo')}}</h3>
                            <p class="description height-equal">
                                {{trans('demo.desvideo')}}
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><img src="{{ URL::asset('frontend/images/h1.jpg') }}" class="img-res" /></a></div>
                            <h3 class="title-description"></h3>
                            <p class="description height-equal">
                                {{trans('demo.des1')}}
                            </p>
                        
                            <audio class="fa fa-volume-up" aria-hidden="true" controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chatdocmaudacam.mp3')}}" type="audio/mpeg" disabled>
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><img src="{{ URL::asset('frontend/images/h2.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description"></h3>
                            <p class="description height-equal">
                                {{trans('demo.des2')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chatdocmaudacam.mp3')}}" type="audio/mpeg" disabled>
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><img src="{{ URL::asset('frontend/images/h3.PNG')}}" class="img-res" /></a></div>
                            <h3 class="title-description"></h3>
                            <p class="description height-equal">
                                {{trans('demo.des3')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chatdocmaudacam.mp3')}}" type="audio/mpeg" disabled>
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><img src="{{ URL::asset('frontend/images/h4.jpg')}}" class="img-res" /></a></div>
                            <h3 class="title-description"></h3>
                            <p class="description height-equal">
                                {{trans('demo.des4')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chatdocmaudacam.mp3')}}" type="audio/mpeg" disabled>
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><img src="{{ URL::asset('frontend/images/h5.PNG')}}" class="img-res" /></a></div>
                            <h3 class="title-description"> </h3>
                            <p class="description height-equal">
                                {{trans('demo.des5')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chatdocmaudacam.mp3')}}" type="audio/mpeg" disabled>
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-detail"><img src="{{ URL::asset('frontend/images/h6.PNG')}}" class="img-res" /></a></div>
                            <h3 class="title-description"></h3>
                            <p class="description height-equal">
                                {{trans('demo.des6')}}
                            </p>
                            <audio controls style="width: 100%">
                                <source src="{{ URL::asset('frontend/audio/chatdocmaudacam.mp3')}}" type="audio/mpeg" disabled>
                                Your browser does not support the audio element.
                            </audio>
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
                <a href="{{ URL::asset('/list2')}}" class="btn btn-default icon-left" title="Continue shopping">
                    <span>{{trans('content.back')}}</span>
                </a>
            </p>
        </section>
@endsection