<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{route('website.home')}}">
                <div class="logo_header"> 
                   <img src="{{asset('website/images/logo fff.png')}}">
                </div>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            {{--users--}}
            <li class="nav-item {{areActiveRoutes(['admin.users.index','admin.users.create','admin.users.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('admin.users')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.users.index')  }}"><a href="{{route('admin.users.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.users')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.users.create')  }}"><a href="{{route('admin.users.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.add_new', ['field' => __('local.user')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end users--}}

            {{--faqs--}}
            <li class="nav-item {{areActiveRoutes(['admin.faqs.index','admin.faqs.create','admin.faqs.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="Faqs">@lang('admin.faqs')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.faqs.index')  }}"><a href="{{route('admin.faqs.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="Faqs">@lang('admin.faqs')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.faqs.create')  }}"><a href="{{route('admin.faqs.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="Faqs">@lang('admin.add_new', ['field' => __('local.faqs')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end faqs--}}

            {{--activities type--}}
            <li class="nav-item {{areActiveRoutes(['admin.activities-types.index','admin.activities-types.create','admin.activities-types.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.activities-types')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.activities-types.index')  }}"><a href="{{route('admin.activities-types.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('local.activities-types')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.activities-types.create')  }}"><a href="{{route('admin.activities-types.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.add_new', ['field' => __('local.activities-types')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end activities-types--}}



            {{--regions--}}
            <li class="nav-item {{areActiveRoutes(['admin.regions.index','admin.regions.create','admin.regions.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.regions')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.regions.index')  }}"><a href="{{route('admin.regions.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('local.regions')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.regions.create')  }}"><a href="{{route('admin.regions.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.add_new', ['field' => __('local.region')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end regions--}}


            {{--cities--}}
            <li class="nav-item {{areActiveRoutes(['admin.cities.index','admin.cities.create','admin.cities.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.cities')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.cities.index')  }}"><a href="{{route('admin.cities.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('local.cities')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.cities.create')  }}"><a href="{{route('admin.cities.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.add_new', ['field' => __('local.city')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end cities--}}
            {{--cars--}}
            <li class="nav-item {{areActiveRoutes(['admin.cars.index','admin.cars.create','admin.cars.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.cars')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.cars.index')  }}"><a href="{{route('admin.cars.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('local.cars')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.cars.create')  }}"><a href="{{route('admin.cars.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.add_new', ['field' => __('local.car')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end cars--}}

            {{--company_sector--}}
            <li class="nav-item {{areActiveRoutes(['admin.company-sectors.index','admin.company-sectors.create','admin.company-sectors.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.company-sectors')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.company-sectors.index')  }}"><a href="{{route('admin.company-sectors.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('local.company-sectors')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.company-sectors.create')  }}"><a href="{{route('admin.company-sectors.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.add_new', ['field' => __('local.company-sectors')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end company_sector--}}

            {{--sliders-services--}}
            <li class="nav-item {{areActiveRoutes(['admin.sliders-services.index','admin.sliders-services.create','admin.sliders-services.edit' ])}}">
                <a href="#">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.our_services_gallery')</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item {{ isActiveRoute('admin.sliders-services.index')  }}"><a href="{{route('admin.sliders-services.index')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('local.our_services_gallery')</span></a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('admin.sliders-services.create')  }}"><a href="{{route('admin.sliders-services.create')}}">
                            <i data-feather='minus'></i>
                            <span class="menu-title" data-i18n="User">@lang('admin.add_new', ['field' => __('local.our_services_gallery')])</span></a>
                    </li>
                </ul>
            </li>
            {{--end sliders-services--}}


            {{--newsletter--}}
            <li class="nav-item {{ isActiveRoute('admin.news-letter.index')  }}"><a href="{{route('admin.news-letter.index')}}">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.news_letter')</span></a>
            </li>

            {{--end--}}


            {{--settings--}}
            <li class="nav-item {{ isActiveRoute('admin.static-pages.index')  }}"><a href="{{route('admin.static-pages.index')}}">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.static-pages')</span></a>
            </li>

            {{--end--}}


            {{--settings--}}
            <li class="nav-item {{ isActiveRoute('admin.settings.index')  }}"><a href="{{route('admin.settings.index')}}">
                    <i data-feather='circle'></i>
                    <span class="menu-title" data-i18n="User">@lang('local.settings')</span></a>
            </li>

            {{--end--}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->