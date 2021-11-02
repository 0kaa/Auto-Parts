<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">

            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
        <ul class="nav navbar-nav align-items-center ml-auto">


            <li class="nav-item dropdown dropdown-language">
                @if(app()->isLocale('ar'))
                    <a class="nav-link " id="dropdown-flag" href="{{route('lang','en')}}"
                      ><i
                                class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                @else

                    <a class="nav-link " id="dropdown-flag" href="{{route('lang','ar')}}"
                      ><i
                                class="flag-icon flag-icon-us"></i><span class="selected-language">عربي</span></a>

                @endif
            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>

            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="javascript:void(0);"
                                                           data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{\Illuminate\Support\Facades\Auth::user()->name}}</span></div>
                    <span class="avatar">
                        <img src="{{auth()->user()->image!=null&&file_exists('storage/'.auth()->user()->image)?asset('storage/'.auth()->user()->image):asset('admin/images/img-upload-placeholder.jpg')}}"
                                              alt="avatar" height="40" width="40"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">

                    {{--<a class="dropdown-item" href="{{route('admin.edit-profile')}}">--}}
                        {{--<i class="mr-50" data-feather="user"></i> {{trans('local.profile')}}</a>--}}

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{route('admin.logout')}}">
                        <i class="mr-50" data-feather="power"></i> {{trans('admin.logout')}}</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


<!-- END: Header-->