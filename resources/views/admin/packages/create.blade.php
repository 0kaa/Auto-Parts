@extends('admin.layout.app')

@section('title',trans('local.common_edit', ['field' =>__('local.packages')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.packages')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('local.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.packages.index') }}">@lang('local.packages')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@lang('local.common_edit', ['field' =>
                                                        __('local.packages')])
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <form class="needs-validation" novalidate="" id="create-packages-form">
                            @csrf()
                            
                            <div class="form-group">

                                <label class="form-label" for="name_ar"> <span class="tx-danger">*</span>
                                    @lang('local.name_ar')</label>
                                <input type="text" id="name_ar" class="form-control" name="name_ar" placeholder=" @lang('local.name_ar')" value="{{isset($packages)?$packages->name_ar:''}}"
                                       aria-label=" @lang('local.name_ar')" aria-describedby="basic-addon-name" required="">
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
                                <input type="text" id="name_en" class="form-control" name="name_en" placeholder=" @lang('local.name_en')" value="{{isset($packages)?$packages->name_en:''}}"
                                       aria-label=" @lang('local.name_en')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="description_ar"> <span class="tx-danger">*</span>
                                    @lang('local.description_ar')</label>
                                <input type="text" id="description_ar" class="form-control" name="description_ar" placeholder=" @lang('local.description_ar')" value="{{isset($packages)?$packages->description_ar:''}}"
                                       aria-label=" @lang('local.description_ar')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">

                                <label class="form-label" for="description_en"> <span class="tx-danger">*</span>
                                    @lang('local.description_en')</label>
                                <input type="text" id="description_en" class="form-control" name="description_en" placeholder=" @lang('local.description_en')" value="{{isset($packages)?$packages->description_en:''}}"
                                       aria-label=" @lang('local.description_en')" aria-describedby="basic-addon-name" required="">
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
                                    <img class="img-fluid" src="@if(isset($package)&&$package->badge!=""){{ file_exists('storage/'.$package->badge)?asset('storage/'.$package->badge ):(file_exists('website/'.$package->badge)?asset('website/'.$package->badge):asset('admin/images/img-upload-placeholder.jpg')) }}
                                    @else{{asset('admin/images/img-upload-placeholder.jpg')}}@endif"
                                         class="preview-img" >

                                    <label class="custom-file">
                                        <input type="file" id="badge"
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

                                <label class="form-label" for="price"> <span class="tx-danger">*</span>
                                    @lang('admin.price')</label>
                                <input type="number" id="price" class="form-control" name="price" placeholder=" @lang('admin.price')" value="{{isset($packages)?$packages->price:''}}"
                                       aria-label=" @lang('admin.price')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="discount"> <span class="tx-danger">*</span>
                                    @lang('local.discount')</label>
                                <input type="number" id="discount" class="form-control" name="discount" placeholder=" @lang('local.discount')" value="{{isset($packages)?$packages->discount:''}}"
                                       aria-label=" @lang('local.discount')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="form-group">

                                <label class="form-label" for="duration_ar"> <span class="tx-danger">*</span>
                                    @lang('local.duration_ar')</label>
                                <input type="text" id="duration_ar" class="form-control" name="duration_ar" placeholder=" @lang('local.duration_ar')" value="{{isset($packages)?$packages->duration_ar:''}}"
                                       aria-label=" @lang('local.duration_ar')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="duration_en"> <span class="tx-danger">*</span>
                                    @lang('local.duration_en')</label>
                                <input type="text" id="duration_en" class="form-control" name="duration_en" placeholder=" @lang('local.duration_en')" value="{{isset($packages)?$packages->duration_en:''}}"
                                       aria-label=" @lang('local.duration_en')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="keyword_ar"> <span class="tx-danger">*</span>
                                    @lang('local.keyword_ar')</label>
                                <input type="text" id="keyword_ar" class="form-control" name="keyword_ar" placeholder=" @lang('local.keyword_ar')" value="{{isset($packages)?$packages->keyword_ar:''}}"
                                       aria-label=" @lang('local.keyword_ar')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="form-group">

                                <label class="form-label" for="keyword_en"> <span class="tx-danger">*</span>
                                    @lang('local.keyword_en')</label>
                                <input type="text" id="keyword_en" class="form-control" name="keyword_en" placeholder=" @lang('local.keyword_en')" value="{{isset($packages)?$packages->keyword_en:''}}"
                                       aria-label=" @lang('local.keyword_en')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>
                            <div id="append_features" data-lang="{{app()->getLocale()}}">
                              
                            </div>

                            <div class="add-divs">
                                <div class="click-add-res click-plus">
                                    <span>+</span>
                                    {{ __('local.add_feature') }}
                                </div>
                                <div class="shep-div">
                
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
        @if(App::isLocale('ar'))
            <!--arabic-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js">
            </script>
        @endif


        @if(isset($packages))
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/packages/update.js') }}"></script>

        @else
        <script type="text/javascript" src="{{ URL::asset('admin/Forms/packages/create.js') }}"></script>
@endif

    @endpush

@endsection
