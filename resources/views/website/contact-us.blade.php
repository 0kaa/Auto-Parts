@extends('website.layout.app')
@section('pageTitle' , trans('admin.website'))
@section('pageSubTitle' , trans('local.contact-us'))
@section('shortcut_icon' , asset('website/images/logo.png'))

@section('content_header')

    <div class="bannr_header" style="background-image: url({{asset('website/images/banner.png')}});">
        <div class="caption">
            <h2>   {{trans('local.contact-us')}}  </h2>
            <p><a href="{{route('website.home')}}"> {{trans('local.home')}} </a> -  <a href="#"> {{trans('local.contact-us')}} </a></p>
        </div>
    </div>

@endsection
@section('content')

    <div class="contectus">
        <div class="container">
            <!-- start title -->
            <div class="title">
                <div class="row align-items-center" >
                    <div class="col-lg-3 col-md-4">
                        <h2> <img src="{{asset('website/images/a2.png')}}" alt=""> {{trans('local.contact-us')}}</h2>
                    </div>
                    <div class="col-lg-9  col-md-8">
                        <div class="shep-title">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end title -->

            <div class="form-contectus">
                <div class="row">
                    <div class="col-lg-8 pg-none">
                        <form id="contact-us" class="sub-contectus">
                            <div class="title_contectus">
                                <h2> {{trans('local.send_us_message')}}  </h2>
                            </div>
                            <div class="input-contectus">
                                <i class="bi bi-person"></i>
                                <input type="text" id="name" name="name" placeholder="{{trans('local.name')}} " class="form-control" required>
                            </div>
                            <div class="input-contectus">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" id="email" placeholder="{{trans('local.email')}}" class="form-control" required>
                            </div>

                            <div class="input-contectus">
                                <i class="bi bi-chat-text"></i>
                                <textarea name="message" id="message" class="form-control" placeholder="{{trans('local.message')}}" cols="" rows=""></textarea>
                            </div>

                            <div class="btn-contectus">
                                <button class="ctm-btn"> {{trans('local.send')}} </button>
                            </div>

                        </form>
                    </div>

                    <div class="col-lg-4 pg-none">
                        <div class="sub2-contectus">
                            <div class="title_contectus">
                                <h2> {{trans('local.send_us_message')}}  </h2>
                            </div>

                            <div class="links-contectus">
                                <ul>
                                    <li><a href="tel:{{ $phone->value }}"> <i class="bi bi-telephone-fill"></i>  {{ $phone->value }}  </a></li>
                                    <li><a href="https://www.google.com/maps/search/?api=1&query={{ $lat->value }},{{ $lng->value }}" target="_blank"> <i class="bi bi-geo-alt-fill"></i>  {{ $address->value }}</a></li>
                                    <li><a href="mailto:{{ $email->value }}"> <i class="bi bi-envelope-fill"></i> {{ $email->value }} </a></li>
                                </ul>
                                <img src="{{asset('website/images/map (5).png')}}" alt="">
                            </div>
                        </div>
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
    <script>
        window.apiWebsiteURL = `{{ config('app.website') }}`;
        window.apiDashboardURL = `{{ config('app.dashboard') }}`;
    </script>
    <script src="{{asset('website/forms/contact-us.js')}}"></script>
    @endsection
