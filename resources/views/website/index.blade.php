@extends('website.layout.app')
@section('pageTitle' , trans('admin.website'))
@section('pageSubTitle' , trans('local.home'))
@section('shortcut_icon' , asset('website/images/logo fff.png'))

@section('content_header')

    <!-- start center_header ===
           ===========  -->
    <div class="center_header">
        <div class="row">
            <!-- start text_header  -->
            <div class="col-lg-7 col-md-6">
                <div class="text_header " data-aos="zoom-in-left"  data-aos-duration="700">
                    <h2>
                        @if(app()->isLocale('en'))
                        {{getSetting('title_pro_en')!=null?getSetting('title_pro_en')->value:'spare parts platform ..'}}
                            @else
                            {{getSetting('title_pro_ar')!=null?getSetting('title_pro_ar')->value:'منصة قطع غيار ..'}}

                        @endif

                    </h2>
                    <p>  @if(app()->isLocale('en'))
                            {{getSetting('descr_pro_en')!=null?getSetting('descr_pro_en')->value:'It seeks to achieve the most difficult equation, which is linking the merchant and the customer in a framework of transparency and mutual interest and achieving the general benefit of both the merchant or the service provider and the service requester.
                          Or buy auto parts'}}
                        @else
                            {{getSetting('descr_pro_ar')!=null?getSetting('descr_pro_ar')->value:'تسعى لتحقيق المعادلة الأصعب و هي الربط بين التاجر وا لعميل في إطار من الشفافية  و المصلحة المتبادلة و تحقيق النفع العام لكل من التاجر أو مقدم الخدمة و طالب الخدمة  منصة قطع غيار تسعى لتوفير الجهد و اختصار الوقت و تقليل التكلفة في عملية بيع
                        . أو اقتناء قطع غيار السيارات '}}

                        @endif
                       ‎
                    </p>

                    <a href="{{route('website.register-now')}}"> {{trans('local.register_with_us')}} <i class="bi bi-arrow-left"></i></a>
                </div>
            </div>
            <!-- end text_header  -->

            <!-- start img_header -->
            <div class="col-lg-5 col-md-6">
                <div class="sub-img-header" data-aos="zoom-in-right"    data-aos-duration="700">
                    <div class="img_header">
                        <img src="{{getSetting('image_pro_index')!=null&&file_exists('storage/'.getSetting('image_pro_index')->value)?asset('storage/'.getSetting('image_pro_index')->value):asset('website/images/01234.png')}}" alt="">
                    </div>

                    <div class="dots_svg">
                        <object data="{{asset('website/svg/XMLID_958_.svg')}}" type="">
                            <img src="{{asset('website/svg/XMLID_958_.svg')}}" alt="">
                        </object>
                    </div>

                </div>
            </div>
            <!-- end img_header -->


        </div>

    </div>

    @endsection

@section('loading')
    <!-- start loading ===
========
===-->
    <div class="loading">
        <div class="over_lay">
        </div>

        <div class="loader1">
            <div class="container loader">

                <span>.</span>
                <span>.</span>
                <span>.</span>
            </div>
        </div>
    </div>


    <!-- end loading ===
    ========
    ===-->
    @endsection

@section('content')
    <!-- start services_index =======
=====================
===== -->
    <div class="services_index">
        <div class="container">
            <div class="title-services_index">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-2 col-2">
                        <div class="img_services_index" data-aos="fade-left"  data-aos-duration="600">
                            <img src="{{asset('website/images/img1.png')}}" alt="">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <div class="img_services_index" data-aos="fade-left"  data-aos-duration="1200">
                            <img src="{{asset('website/images/img1.png')}}" alt="">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" >
                        <div class="text_services_index"  data-aos="zoom-in-up" data-aos-duration="1500">
                            <object data="{{asset('website/svg/logo green.svg')}}" type="">
                                <img src="{{asset('website/svg/logo green.svg')}}" alt="">
                            </object>

                            <h2> {{trans('local.our_services')}}</h2>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <div class="img_services_index textright"  data-aos="fade-right"  data-aos-duration="1200">
                            <img src="{{asset('website/images/img1.png')}}" alt="" >
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <div class="img_services_index textright"  data-aos="fade-right"  data-aos-duration="600">
                            <img src="{{asset('website/images/img1.png')}}" alt="">
                        </div>
                    </div>



                </div>
            </div>

            <div class="sub_services_index">
                <div class="row ">
                    <div class="col-lg-4 col-md-4 ">
                        <div class="sub_services_index_main" data-aos="fade-left" >
                            <div class="sub_services_index-img">
                                <img src="{{asset('website/images/1.png')}}" alt="">
                            </div>

                            <div class="sub_services_index-text" >
                                <h3> {{trans('local.auto_parts')}}</h3>
                                <span>( {{trans('local.soon')}} ) </span>
                            </div>

                            <div class="arrow-sub_services_index">
                                <img src="{{asset('website/images/01.png')}}" alt="">
                            </div>
                        </div>


                        <div class="sub_services_index_main" data-aos="fade-left" >
                            <div class="sub_services_index-img">
                                <img src="{{asset('website/images/03.png')}}" alt="">
                            </div>

                            <div class="sub_services_index-text">
                                <h3>{{trans('local.tires')}}</h3>
                            </div>

                            <div class="arrow-sub_services_index">
                                <img src="{{asset('website/images/02.png')}}" alt="">
                            </div>
                        </div>

                    </div>



                    <div class="col-lg-4 col-md-4">
                        <div class="sub_services_index_main-img"  data-aos="zoom-in-up" data-aos-duration="1000">
                            <img src="{{asset('website/images/2.png')}}" alt="">
                        </div>


                        <div class="new_sub_services_index_main">
                            <div class="new_arrow-sub_services_index">
                                <img src="{{asset('website/images/Line 345.png')}}" alt="">
                            </div>

                            <div class="new-sub_services_index">
                                <div class="sub_services_index-img">
                                    <img src="{{asset('website/images/4.png')}}" alt="">
                                </div>

                                <div class="sub_services_index-text">
                                    <h3>{{trans('local.oils')}} </h3>
                                </div>

                            </div>
                        </div>



                    </div>





                    <div class="col-lg-4  col-md-4">
                        <div class="sub_services_index_main" data-aos="fade-right" >
                            <div class="arrow-sub_services_index">
                                <img src="{{asset('website/images/03.png')}}" alt="">
                            </div>
                            <div class="sub_services_index-img">
                                <img src="{{asset('website/images/car-parts.png')}}" alt="">
                            </div>

                            <div class="sub_services_index-text">
                                <h3> {{trans('local.repair_spare_parts')}} </h3>
                            </div>

                        </div>


                        <div class="sub_services_index_main" data-aos="fade-right">

                            <div class="arrow-sub_services_index">
                                <img src="{{asset('website/images/04.png')}}" alt="">
                            </div>
                            <div class="sub_services_index-img">
                                <img src="{{asset('website/images/5.png')}}" alt="">
                            </div>

                            <div class="sub_services_index-text">
                                <h3>  {{trans('local.car_care')}} </h3>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- end services_index =======
    =====================
    ===== -->




    <!-- start aboutus_index
    =================
    =======-->
    <div class="aboutus_index">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 ">
                    <!-- start  sub-img-about-index -->
                    <div class="sub-img-about-index">
                        <div class="img_aboutus_index">
                            <img class="img-big" src="{{isset($about_us)&&file_exists('storage/'.$about_us->main_image_home)?asset('storage/'.$about_us->main_image_home):asset('website/images/cccc.png')}}" alt="">
                            <img  class="img-small" src="{{isset($about_us)&&file_exists('storage/'.$about_us->sub_image_home)?asset('storage/'.$about_us->sub_image_home):asset('images/car-parts-white-background_127657-16593.png')}}" alt="">
                        </div>
                        <div class="over-img-about-index">
                            <object data="{{asset('website/svg/XMLID_958_.svg')}}" type="">
                                <img src="{{asset('website/svg/XMLID_958_.svg')}}" alt="">
                            </object>
                        </div>
                    </div>
                    <!-- end sub-img-about-index -->
                </div>

                <!-- start text-about-index  -->
                <div class="col-lg-6 col-md-6">
                    <div class="text-about-index">
                        <h2>  <img src="{{asset('website/images/a2.png')}}" alt="">    @if(isset($about_us)){{app()->isLocale('en')?$about_us->title_en:$about_us->title_ar}} @else {{trans('local.about_us')}}  @endif</h2>
                        <p> @if(isset($about_us)) {!! app()->isLocale('en')?$about_us->desc_en:$about_us->desc_ar !!}@else
                                {{app()->isLocale('en')?'It is a comprehensive application between the merchant and the consumer under one roof with the aim of facilitating the sale between the two parties and with the aim of saving time and effort. In search of the required parts for the consumer'
                            :'هو تطبيق جامع بين التاجر والمستهلك تحت سقف واحد بهدف تسهيل البيع بين الطرفين و بهدف اخر توفير الجهد والوقت . في البحث عن القطع المطلوب للمستهلك'}}
                            @endif
       ‎</p>
                        <a href="{{route('website.static-page','about-us')}}" class="ctm-btn"> {{trans('local.read_more')}}   <i class="bi bi-arrow-left"></i></a>
                    </div>
                </div>
                <!-- end text-about-index  -->
            </div>
        </div>
    </div>


    <!-- end aboutus_index
    =================
    =======-->



    <!-- start ervices-index
   ================
   ==========-->

    <div class="services-index">
        <div class="container">
            <!-- start title -->
            <div class="title">
                <div class="row align-items-center" >
                    <div class="col-lg-3  col-md-4">
                        <h2> <img src="{{asset('website/images/a2.png')}}" alt=""> {{trans('local.features_our_services')}}  </h2>
                    </div>
                    <div class="col-lg-9  col-md-8">
                        <div class="shep-title">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end title -->

            <div class="new_services_index">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="new_sub_services_index">
                            <div class="new_img_sub_services_index">
                                <img src="{{asset('website/images/dollar.png')}}" alt="">
                            </div>
                            <h2>{{trans('local.lower_price')}}</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="new_sub_services_index">
                            <div class="new_img_sub_services_index">
                                <img src="{{asset('website/images/effective.png')}}" alt="">
                            </div>
                            <h2>{{trans('local.effort_saving')}} </h2>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-4">
                        <div class="new_sub_services_index">
                            <div class="new_img_sub_services_index">
                                <img src="{{asset('website/images/time.png')}}" alt="">
                            </div>
                            <h2>{{trans('local.time_saving')}}</h2>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    {{--end--}}

    @push('class_footer')
       <?php
       echo  'class="footer" style="background-image: url(svg/vector.svg);"';
?>
    @endpush


    @push('newsletter')

        <div class="newsletter">
            <div class="container">
                <form action="#" method="POST" id="newsletter" class="news_letter" onsubmit="return false" enctype="multipart/form-data" >
                <div class="row">
                    <div class="col-lg-12">
                        <h2> <img src="{{asset('website/images/a2.png')}}" alt=""> {{trans('local.news_letter')}} </h2>
                        <p> {{trans('local.enter_email_to_follow_news')}}</p>
                        <div class="input_newsletter">
                            <i class="bi bi-envelope"></i>
                            <input type="text" class="form-control" name="email" id="email" placeholder="{{trans('local.email')}}">
                            <div class="alert alert-danger mg-t-20" role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-ios-close alert-icon tx-32"></i>
                                    <span></span>
                                </div>
                            </div>
                            <button> {{trans('local.subscribe')}}</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

    @endpush

    @endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    @if(App::isLocale('ar'))
        <!--arabic-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js">
        </script>
    @endif
<script src="{{asset('website/forms/index.js')}}"></script>


    @endsection