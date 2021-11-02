@extends('website.layout.app')
@section('pageTitle' , trans('admin.website'))

@section('pageSubTitle' ,  $static_page->title )

@section('shortcut_icon' , asset('website/images/logo.png'))

@section('content_header')

    <div class="bannr_header" style="background-image: url({{asset('website/images/banner.png')}});">
        <div class="caption">
            <h2>   {{ $static_page->title }}  </h2>
            <p><a href="{{route('website.home')}}"> {{trans('local.home')}} </a> -  <a href="#"> {{$static_page->title}} </a></p>
        </div>
    </div>

@endsection
@section('content')



<div class="privacy-policy">
    <div class="container">
        <!-- start title -->
        <div class="title">
            <div class="row align-items-center" >
                <div class="col-lg-3 col-md-4">
                    <h2> <img src="images/a2.png" alt=""> {{ $static_page->title }} </h2>
                </div>  
                <div class="col-lg-9  col-md-8">
                    <div class="shep-title">
                    </div>
                </div>
            </div>
        </div>
        <!-- end title -->


        <div class="text_privacy_policy">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        {!! $static_page->content !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    @if(App::isLocale('ar'))
        <!--arabic-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js">
        </script>
    @endif
    <script src="{{asset('website/forms/contact-us.js')}}"></script>
    @endsection
