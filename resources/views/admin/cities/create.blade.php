@extends('admin.layout.app')

@section('title',isset($city)?trans('local.common_edit', ['field' =>__('local.city')]):trans('admin.add_new', ['field' =>__('local.city')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.cities')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('admin.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.cities.index') }}">@lang('local.cities')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@if(isset($city))
                                                            @lang('local.common_edit', ['field' =>__('local.city')])
                                                        @else
                                                            @lang('admin.add_new', ['field' =>
                                                        __('local.city')])
                                                        @endif
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate="" id="{{isset($city)?'update-city-form':'create-city-form'}}">

                            <div class="form-group">

                                <label class="form-label" for="name_ar"> <span class="tx-danger">*</span>
                                    @lang('local.name_ar')</label>
                                <input type="text" id="name_ar" class="form-control" placeholder=" @lang('local.name_ar')"
                                       aria-label=" @lang('local.name_ar')" value="{{isset($city)?$city->name_ar:''}}" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="name_en"> <span class="tx-danger">*</span>
                                    @lang('local.name_en')</label>
                                <input type="text" id="name_en" class="form-control" placeholder=" @lang('local.name_en')"
                                       aria-label=" @lang('local.name_en')" value="{{isset($city)?$city->name_en:''}}" aria-describedby="basic-addon-name" required="">
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

        @if(isset($city))
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/city/update.js') }}"></script>

        @else
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/city/create.js') }}"></script>
        @endif

    @endpush

@endsection
