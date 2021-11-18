@extends('admin.layout.app')

@section('title',isset($car)?trans('local.common_edit', ['field' =>__('local.car')]):trans('admin.add_new', ['field' =>__('local.car')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.cars')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('admin.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.cars.index') }}">@lang('local.cars')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@if(isset($car))
                                                            @lang('local.common_edit', ['field' =>__('local.car')])
                                                        @else
                                                            @lang('admin.add_new', ['field' =>
                                                        __('local.car')])
                                                        @endif
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate="" id="{{isset($car)?'update-car-form':'create-car-form'}}">

                            <div class="form-group">

                                <label class="form-label" for="name_ar"> <span class="tx-danger">*</span>
                                    @lang('local.name_ar')</label>
                                <input type="text" id="name_ar" class="form-control" placeholder=" @lang('local.name_ar')"
                                       aria-label=" @lang('local.name_ar')" value="{{isset($car)?$car->name_ar:''}}" aria-describedby="basic-addon-name" required="">
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
                                       aria-label=" @lang('local.name_en')" value="{{isset($car)?$car->name_en:''}}" aria-describedby="basic-addon-name" required="">
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
                                    <img class="img-fluid" src="@if(isset($car)&&$car->image!=""){{ file_exists('storage/'.$car->image)?asset('storage/'.$car->image ):(file_exists('website/'.$car->image)?asset('website/'.$car->image):asset('admin/images/img-upload-placeholder.jpg')) }}
                                    @else{{asset('admin/images/img-upload-placeholder.jpg')}}@endif"
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

        @if(isset($car))
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/car/update.js') }}"></script>

        @else
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/car/create.js') }}"></script>
        @endif

    @endpush

@endsection
