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


                        <form class="needs-validation" novalidate="" id="update-user-form">

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

        <script type="text/javascript" src="{{ URL::asset('admin/Forms/users/edit.js') }}"></script>

{{--        <script type="text/javascript" src="{{ URL::asset('admin/Forms/users/handle-user.js') }}"></script>--}}

    @endpush

@endsection
