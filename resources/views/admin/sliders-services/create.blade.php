@extends('admin.layout.app')

@section('title',isset($slider_service)?trans('local.common_edit', ['field' =>__('local.our_services_gallery')]):trans('admin.add_new', ['field' =>__('local.our_services_gallery')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.our_services_gallery')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('admin.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.sliders-services.index') }}">@lang('local.our_services_gallery')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@if(isset($slider_service))
                                                            @lang('local.common_edit', ['field' =>__('local.our_services_gallery')])
                                                        @else
                                                            @lang('admin.add_new', ['field' =>
                                                        __('local.our_services_gallery')])
                                                        @endif
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate=""  id="{{isset($slider_service)?'update-sliders-services-form':'create-sliders-services-form'}}">

                            <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('admin.image'): <span class="tx-danger">*</span> </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img height="40%" width="40%" src="{{ isset($slider_service)&&file_exists('storage/'.$slider_service->image)?asset('storage/'.$slider_service->image ):asset('admin/images/img-upload-placeholder.jpg') }}"
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



        @if(isset($slider_service))
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/sliders-services/update.js') }}"></script>

        @else
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/sliders-services/create.js') }}"></script>
        @endif

    @endpush

@endsection
