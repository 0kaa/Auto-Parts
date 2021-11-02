@extends('website.layout.app')
@section('pageTitle' , trans('admin.website'))
@section('pageSubTitle' , trans('local.about_us'))
@section('shortcut_icon' , asset('website/images/logo.png'))

@section('content_header')

    <div class="bannr_header" style="background-image: url({{asset('website/images/banner.png')}});">
        <div class="caption">
            <h2>  {{trans('local.about_us')}}  </h2>
            <p><a href="{{route('website.home')}}"> {{trans('local.home')}} </a> -  <a href="#">{{trans('local.about_us')}}</a></p>
        </div>
    </div>

@endsection
@section('content')
    <!-- start aboutus =====
====================
=========== -->



    <div class="aboutus">
        <div class="container">
            <!-- start title -->
            <div class="title">
                <div class="row align-items-center" >
                    <div class="col-lg-2  col-md-4">
                        <h2> <img src="{{asset('website/images/a2.png')}}" alt=""> {{trans('local.about_us')}} </h2>
                    </div>
                    <div class="col-lg-10  col-md-8">
                        <div class="shep-title">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end title -->

            <div class="sub-aboutus">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="img_sub_aboutus">
                            <div class="big-img">
                                <img src="{{isset($about_us)&&file_exists('storage/'.$about_us->main_image)?asset('storage/'.$about_us->main_image):asset('website/images/ttttt.png')}}" alt="">
                            </div>
                            <div class="small-img">
                                <img src="{{isset($about_us)&&file_exists('storage/'.$about_us->sub_image)?asset('storage/'.$about_us->sub_image):asset('website/images/242365346.png')}}" alt="">
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6">
                        <div class="text-sub-about">
                            <h2> @if(isset($about_us)){{app()->isLocale('en')?$about_us->title_en:$about_us->title_ar}} @else {{trans('local.about_us')}}  @endif</h2>
                            <p>@if(isset($about_us)) {!! app()->isLocale('en')?$about_us->desc_en:$about_us->desc_ar !!}@else
                                    {{app()->isLocale('en')?'It is a comprehensive application between the merchant and the consumer under one roof with the aim of facilitating the sale between the two parties and with the aim of saving time and effort. In search of the required parts for the consumer'
                                :'هو تطبيق جامع بين التاجر والمستهلك تحت سقف واحد بهدف تسهيل البيع بين الطرفين و بهدف اخر توفير الجهد والوقت . في البحث عن القطع المطلوب للمستهلك'}}
                                @endif‎</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div class="statistics-about">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($activities_type as $activity_type)
                    <div class="col-lg-4 col-md-6">
                        <div class="sub-statistics-about">
                            <!--SINGLE ITEM-->
                            <div class="img-statistics-about">
                                <img src="@if(isset($activity_type)&&$activity_type->image!=""){{ file_exists('storage/'.$activity_type->image)?asset('storage/'.$activity_type->image ):(file_exists('website/'.$activity_type->image)?asset('website/'.$activity_type->image):asset('admin/images/img-upload-placeholder.jpg')) }}
                                @else{{asset('admin/images/img-upload-placeholder.jpg')}}@endif" alt="">
                            </div>

                            <div class="single_counter_item">
                                <h3> @if($activity_type->name_en=='car care') % @elseif($activity_type->name_en=='repair spare parts') @else + @endif <span class="timer">{{$activity_type->num_pieces}}</span></h3>
                            </div>

                            <p>
                                {{app()->isLocale('en')?$activity_type->name_en:$activity_type->name_ar}}
                            </p>
                            <!--SINGLE ITEM-->
                        </div>
                    </div>
                    @endforeach





                </div>
            </div>
        </div>


        <div class="services-other">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-services-other">
                            <h2> {{trans('local.our_services_gallery')}} </h2>
                            <p>     @if(app()->isLocale('en'))
                                    {{getSetting('desc_our_services_gallery_en')!=null?getSetting('desc_our_services_gallery_en')->value:'This text is an example of text that can be replaced in the same space'}}
                                @else
                                    {{getSetting('desc_our_services_gallery_ar')!=null?getSetting('desc_our_services_gallery_ar')->value:'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة'}}

                                @endif</p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="owl-carousel owl-theme maincarousel" id="owl-demo">
                            @foreach($slider_services as $slider_service)
                            <div class="item">
                                <div class="img-slider">
                                    <img src="{{file_exists('storage/'.$slider_service->image)?asset('storage/'.$slider_service->image):asset('admin/images/img-upload-placeholder.jpg')}}" alt="">
                                </div>
                            </div>
                            @endforeach





                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>









    <!-- end aboutus =====
 ====================
 =========== -->


    @push('class_footer')
        <?php
        echo  'class="footer1" ';
        ?>
    @endpush

    @push('footer_pages')
    <div class="col-lg-12">
        <div class="logo-footer">
            <img src="{{asset('website/images/logo fff.png')}}" alt="">
        </div>
    </div>
    @endpush
@endsection
