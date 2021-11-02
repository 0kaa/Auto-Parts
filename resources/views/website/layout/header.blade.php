<header>
    <div class="header">
        <div class="container">
            <div class="top_par">
                <div class="row align-items-center ">
                    <!-- start logo -->
                    <div class="col-lg-3 col-md-2">
                        <div class="logo">
                            <a href="{{route('website.home')}}">
                                <object data="{{asset('website/svg/logo.svg')}}">
                                    <img src="{{asset('website/svg/logo.svg')}}" alt="">
                                </object>
                            </a>
                        </div>
                    </div>
                    <!-- end logo -->

                    <!-- start element  -->
                    <div class="col-lg-6  col-md-6">
                        <div class="element"  id="menu-div">
                            <div class="logo-mune">
                                <object data="{{asset('website/svg/logo.svg')}}">
                                    <img src="{{asset('website/svg/logo.svg')}}" alt="">
                                </object>

                            </div>
                            <ul>

                                <li @if(Route::currentRouteName()=='website.home') class="active" @endif><a href="{{route('website.home')}}"> {{trans('local.home')}}</a></li>
                                <li @if(\Request::segment(2)=='about-us') class="active" @endif><a href="{{route('website.static-page','about-us')}}">  {{trans('local.about_us')}}</a></li>
                                <li @if(Route::currentRouteName()=='website.contact-us') class="active" @endif><a href="{{route('website.contact-us')}}"> {{trans('local.contact-us')}} </a></li>

                            </ul>
                            <div class="user-header-mune">
                               
                                <a href="{{route('website.register-now')}}">
                                    <i class="fas fa-user"></i>
                                </a>
                              
                            </div>
                        </div>

                    </div>
                    <!-- end element  -->


                    <!-- start language -->
                    <div class="col-lg-3  col-md-4">

                        <div class="user-header">
                          
                                <a href="{{route('website.register-now')}}">
                                    <i class="fas fa-user"></i>
                                </a>
                       

                        </div>

                        <div class="language">
                            @if(app()->isLocale('ar'))

                                <a href="{{route('lang','en')}}">   <i class="bi bi-globe"></i> English  </a>

                            @else

                                <a href="{{route('lang','ar')}}">   <i class="bi bi-globe"></i> عربي  </a>

                            @endif
                        </div>
                    </div>
                    <!-- start language -->


                </div>
            </div>

            @yield('content_header')

            <!-- icon-mune -->
            <div class="times" id="times-ican">
                <i class="fas fa-bars"></i>
            </div>
            <!-- -------- -->
        </div>
    </div>
</header>
