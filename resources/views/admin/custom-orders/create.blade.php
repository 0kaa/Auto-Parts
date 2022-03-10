@extends('admin.layout.app')

@section('title',trans('admin.add_new', ['field' =>__('local.user')]))
@section('description', trans('admin.home_description'))
@push('cs')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endpush
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="content-wrapper">
                            <div class="content-header row">
                                <div class="content-header-left col-md-9 col-12 mb-2">
                                    <div class="row breadcrumbs-top">
                                        <div class="col-12">
                                            <h2 class="content-header-title float-left mb-0">@lang('admin.users')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('admin.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.users.index') }}">@lang('admin.users')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@lang('admin.add_new', ['field' =>
                                                        __('local.user')])
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate="" id="create-user-form">

                            <div class="form-group">

                                <label class="form-label" for="name"> <span class="tx-danger">*</span>
                                    @lang('local.name')</label>
                                <input type="text" id="name" class="form-control" placeholder=" @lang('local.name')"
                                       aria-label=" @lang('local.name')" value="{{isset($user)?$user->name:''}}" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="email"> <span class="tx-danger">*</span>
                                    @lang('local.email')</label>
                                <input type="email" id="email" class="form-control" value="{{isset($user)?$user->email:''}}" autocomplete="off" placeholder=" @lang('local.email')"
                                       aria-label=" @lang('local.email')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="phone"> <span class="tx-danger">*</span>
                                    @lang('local.phone')</label>
                                <input type="text" id="phone" class="form-control" placeholder=" @lang('local.phone')" value="{{isset($user)?$user->phone:''}}"
                                       aria-label=" @lang('local.phone')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="password"> <span class="tx-danger">*</span>
                                    @lang('local.password')</label>
                                <input type="password" id="password" class="form-control" autocomplete="off" placeholder=" @lang('local.password')"
                                       aria-label=" @lang('local.password')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>



                            <div class="form-group">

                                <label class="form-label" for="confirm_password"> <span class="tx-danger">*</span>
                                    @lang('local.confirm_password')</label>
                                <input type="password" id="confirm_password" class="form-control" placeholder=" @lang('local.confirm_password')"
                                       aria-label=" @lang('local.confirm_password')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('admin.image'): <span class="tx-danger">*</span> </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img src="@if(isset($user))
                                    {{ file_exists('storage/'.$user->image)?asset('storage/'.$user->image ):(file_exists($user->image)?asset($user->image):asset('admin/images/img-upload-placeholder.jpg')) }}
                                            @else
                                            {{asset('admin/images/img-upload-placeholder.jpg')}}
                                            @endif"
                                         class="preview-img" >

                                    <label class="custom-file">
                                        <input type="file" id="image"
                                               class="form-control-file upload-img"/>
                                        <span class="custom-file-control custom-file-control-primary">
                                    </span>
                                    </label>

                                    <div class="alert alert-danger mg-t-20" role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-32"></i>
                                            <span></span>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">

                                <label class="form-label" for="type"> <span class="tx-danger">*</span>
                                    @lang('local.type_user')</label>
                                <select id="type_user" class="form-control select2-show-search"
                                        placeholder=" @lang('local.type_user')" aria-label=" @lang('local.type_user')"
                                        aria-describedby="basic-addon-name" required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>
                                    <option value="user">@lang('local.user')</option>
                                    <option value="owner_store" >@lang('local.owner_store')</option>
                                    <option value="workshop" >@lang('local.workshop')</option>

                                </select>

                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="activity_type_id"> <span class="tx-danger">*</span>
                                    @lang('local.activities-types')</label>
                                <select id="activity_type_id" class="form-control select2-show-search"
                                        placeholder=" @lang('local.activities-types')" aria-label=" @lang('local.activities-types')"
                                        aria-describedby="basic-addon-name" required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>

                                    @foreach($activities_type as $activity_type)
                                    <option value="{{$activity_type->id}}" >{{app()->isLocale('en')?$activity_type->name_en:$activity_type->name_ar}}</option>
                                        @endforeach
                                </select>

                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="name_company"> <span class="tx-danger">*</span>
                                    @lang('local.name_company')</label>
                                <input type="text" id="name_company" class="form-control" placeholder=" @lang('local.name_company')" value="{{isset($user)?$user->name_company:''}}"
                                       aria-label=" @lang('local.name_company')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="name_owner_company"> <span class="tx-danger">*</span>
                                    @lang('local.name_owner_company')</label>
                                <input type="text" id="name_owner_company" class="form-control" placeholder=" @lang('local.name_owner_company')" value="{{isset($user)?$user->name_owner_company:''}}"
                                       aria-label=" @lang('local.name_owner_company')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="national_identity"> <span class="tx-danger">*</span>
                                    @lang('local.national_identity')</label>
                                <input type="text" id="national_identity" class="form-control" placeholder=" @lang('local.national_identity')" value="{{isset($user)?$user->national_identity:''}}"
                                       aria-label=" @lang('local.national_identity')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="date"> <span class="tx-danger">*</span>
                                    @lang('local.date')</label>
                                <input type="date" id="date" class="form-control" placeholder=" @lang('local.date')" value="{{isset($user)?$user->date:''}}"
                                       aria-label=" @lang('local.national_identity')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('local.image_commercial_register'): <span class="tx-danger">*</span> </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img src="@if(isset($user))
                                    {{ file_exists('storage/'.$user->file)?asset('storage/'.$user->file ):(file_exists($user->file)?asset($user->file):asset('admin/images/img-upload-placeholder.jpg')) }}
                                            @else
                                            {{asset('admin/images/img-upload-placeholder.jpg')}}
                                            @endif"
                                         class="preview-img" >

                                    <label class="custom-file">
                                        <input type="file" id="file"
                                               class="form-control-file upload-img"/>
                                        <span class="custom-file-control custom-file-control-primary">
                                    </span>
                                    </label>

                                    <div class="alert alert-danger mg-t-20" role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-32"></i>
                                            <span></span>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">

                                <label class="form-label" for="ibn"> <span class="tx-danger">*</span>
                                    @lang('local.ibn')</label>
                                <input type="text" id="ibn" class="form-control" placeholder=" @lang('local.ibn')" value="{{isset($user)?$user->ibn:''}}"
                                       aria-label=" @lang('local.ibn')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="region_id"> <span class="tx-danger">*</span>
                                    @lang('local.region')</label>
                                <select id="region_id" class="form-control select2-show-search"
                                        placeholder=" @lang('local.region')" aria-label=" @lang('local.region')"
                                        aria-describedby="basic-addon-name" required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>

                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}" >{{app()->isLocale('en')?$region->name_en:$region->name_ar}}</option>
                                    @endforeach
                                </select>

                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="city_id"> <span class="tx-danger">*</span>
                                    @lang('local.city')</label>
                                <select id="city_id" class="form-control select2-show-search"
                                        placeholder=" @lang('local.city')" aria-label=" @lang('local.city')"
                                        aria-describedby="basic-addon-name" required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>

                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" >{{app()->isLocale('en')?$city->name_en:$city->name_ar}}</option>
                                    @endforeach
                                </select>

                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            {{-- <div class="form-group">

                                <label class="form-label" for="city"> <span class="tx-danger">*</span>
                                    @lang('local.city')</label>
                                <input type="text" id="city" class="form-control" placeholder=" @lang('local.city')" value="{{isset($user)?$user->city:''}}"
                                       aria-label=" @lang('local.city')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div> --}}


                            <div class="form-group">

                                <label class="form-label" for="is_company_facility_agent"> <span class="tx-danger">*</span>
                                    @lang('local.is_company_facility_agent')</label>
                                <select id="is_company_facility_agent" class="form-control select2-show-search"
                                        placeholder=" @lang('local.is_company_facility_agent')" aria-label=" @lang('local.is_company_facility_agent')"
                                        aria-describedby="basic-addon-name" required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>
                                    <option value="yes">@lang('local.yes')</option>
                                    <option value="no">@lang('local.no')</option>

                                </select>

                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="is_company_facility_authorized_distributor"> <span class="tx-danger">*</span>
                                    @lang('local.is_company_facility_authorized_distributor')</label>
                                <select id="is_company_facility_authorized_distributor" class="form-control select2-show-search"
                                        placeholder=" @lang('local.is_company_facility_authorized_distributor')" aria-label=" @lang('local.is_company_facility_authorized_distributor')"
                                        aria-describedby="basic-addon-name" required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>
                                    <option value="yes">@lang('local.yes')</option>
                                    <option value="no">@lang('local.no')</option>

                                </select>

                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="company_sector_id"> <span class="tx-danger">*</span>
                                    @lang('local.company_sector')</label>
                                <select id="company_sector_id" class="form-control select2-show-search"
                                        placeholder=" @lang('local.region')" aria-label=" @lang('local.region')"
                                        aria-describedby="basic-addon-name" required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>

                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}" >{{app()->isLocale('en')?$region->name_en:$region->name_ar}}</option>
                                    @endforeach
                                </select>

                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label>@lang('admin.select_location_on_map') </label>

                                    <input id="address" class=" form-control" type="hidden" >

                                    <div class="alert alert-danger mg-t-20" role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-32"></i>
                                            <span></span>
                                        </div>
                                    </div>


                                    <br>
                                    <div class="col-lg-12">
                                        <input id="searchInput" class=" form-control"  placeholder="@lang('admin.search_map')" name="other">




                                        <div id="map"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" id="lat" name="lat" readonly="" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" id="longitude" name="lat" readonly="" class="form-control" required>
                                    </div>

                                </div>

                            </div>



                            <br>
                            <br>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                            class="btn btn-primary waves-effect waves-float waves-light">@lang('admin.submit')</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script type="text/javascript" src="{{ URL::asset('admin/Forms/Maps/create.js') }}"></script>

        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs" async></script>

        <script type="text/javascript" src="{{ URL::asset('admin/Forms/users/create.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('admin/Forms/users/handle-user.js') }}"></script>

    @endpush

@endsection
