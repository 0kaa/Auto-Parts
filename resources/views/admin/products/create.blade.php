@extends('admin.layout.app')

@section('title', trans('admin.add_new', ['field' => __('local.products')]))
@section('description', trans('admin.home_description'))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.products')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                            href="{{ route('admin.dashboard') }}">@lang('local.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                            href="{{ route('admin.products_index') }}">@lang('local.products')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@lang('local.common_edit', ['field' => __('local.products')])
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <form class="needs-validation" novalidate="" id="create-products-form">
                            @csrf()

                            <div class="form-group">

                                <label class="form-label" for="name"> <span class="tx-danger">*</span>
                                    @lang('local.name')</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder=" @lang('local.name')" aria-label=" @lang('local.name')"
                                    aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="description"> <span class="tx-danger">*</span>
                                    @lang('local.description')</label>
                                <input type="text" id="description" class="form-control" name="description"
                                    placeholder=" @lang('local.description')" aria-label=" @lang('local.description')"
                                    aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('admin.image'): <span class="tx-danger">*</span>
                                </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img class="img-fluid"
                                        src="@if (isset($product) && $product->badge != '') {{ file_exists('storage/' . $package->badge) ? asset('storage/' . $package->badge) : (file_exists('website/' . $package->badge) ? asset('website/' . $package->badge) : asset('admin/images/img-upload-placeholder.jpg')) }}
                                    @else{{ asset('admin/images/img-upload-placeholder.jpg') }} @endif"
                                        class="preview-img">

                                    <label class="custom-file">
                                        <input type="file" id="image" class="form-control-file upload-img" />
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

                                <label class="form-label" for="price"> <span class="tx-danger">*</span>
                                    @lang('admin.price')</label>
                                <input type="number" id="price" class="form-control" name="price"
                                    placeholder=" @lang('admin.price')" aria-label=" @lang('admin.price')"
                                    aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="seller_id"> <span class="tx-danger">*</span>
                                    @lang('admin.seller_id')</label>
                                    <select class="form-select form-control " id="seller_id" aria-label="Default select example" required>
                                        <option selected>{{ __('admin.owner_store') }}</option>
                                        @foreach ($sellers as $seller)
                                            <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                        @endforeach
                                    </select>
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div id="append_features" data-lang="{{ app()->getLocale() }}">

                            </div>

                            <div class="add-divs">
                                <div class="click-add-res click-plus">
                                    <span>+</span>
                                    {{ __('local.add_feature') }}
                                </div>
                                <div class="shep-div">

                                </div>
                            </div>

                            <div id="append_details" data-lang="{{ app()->getLocale() }}">

                            </div>

                            <div class="add-divs">
                                <div class="click-add-res click-plus-two">
                                    <span>+</span>
                                    {{ __('local.add_details') }}
                                </div>
                                <div class="detail-div">

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
        @if (App::isLocale('ar'))
            <!--arabic-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
        @endif


        @if (isset($products))
            <script type="text/javascript" src="{{ URL::asset('admin/products/update.js') }}"></script>
        @else
            <script type="text/javascript" src="{{ URL::asset('admin/products/create.js') }}"></script>
        @endif

    @endpush

@endsection
