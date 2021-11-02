@extends('admin.layout.app')

@section('title',trans('local.common_edit', ['field' =>__('local.static-pages')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.static-pages')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('local.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.static-pages.index') }}">@lang('local.static-pages')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@lang('local.common_edit', ['field' =>
                                                        __('local.static-pages')])
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate="" id="update-static-page-form">

                            <div class="form-group">

                                <label class="form-label" for="title_ar"> <span class="tx-danger">*</span>
                                    @lang('admin.title_ar')</label>
                                <input type="text" id="title_ar" class="form-control" placeholder=" @lang('admin.title_ar')" readonly disabled value="{{$static_page->title_ar}}"
                                       aria-label=" @lang('admin.title_ar')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="title_en"> <span class="tx-danger">*</span>
                                    @lang('admin.title_en')</label>
                                <input type="text" id="title_en" class="form-control" placeholder=" @lang('admin.title_en')" readonly disabled value="{{$static_page->title_en}}"
                                       aria-label=" @lang('admin.title_en')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

@if($static_page->slug=='about-us')
                            <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('local.main_image'): <span class="tx-danger">*</span> </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img src="{{ file_exists('storage/'.$static_page->main_image)?asset('storage/'.$static_page->main_image ):(file_exists($static_page->main_image)?asset($static_page->main_image):asset('admin/images/img-upload-placeholder.jpg')) }}"
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

                                <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('local.sub_image'): <span class="tx-danger">*</span> </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img src="{{file_exists('storage/'.$static_page->sub_image)?asset('storage/'.$static_page->sub_image ):(file_exists($static_page->sub_image)?asset($static_page->sub_image):asset('admin/images/img-upload-placeholder.jpg'))  }}"
                                         class="preview-img" >

                                    <label class="custom-file">
                                        <input type="file" id="sub_image"
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


                                <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('local.main_image_home'): <span class="tx-danger">*</span> </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img src="{{file_exists('storage/'.$static_page->main_image_home)?asset('storage/'.$static_page->main_image_home ):(file_exists($static_page->main_image_home)?asset($static_page->main_image_home):asset('admin/images/img-upload-placeholder.jpg'))  }}"
                                         class="preview-img" >

                                    <label class="custom-file">
                                        <input type="file" id="main_image_home"
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

                                <div class="col-md-6">
                                <h5 class="tx-gray-800 mg-b-5">@lang('local.sub_image_home'): <span class="tx-danger">*</span> </h5>
                                <p class="mg-b-20"> </p>
                                <div class="form-group">
                                    <img  src="{{file_exists('storage/'.$static_page->sub_image_home)?asset('storage/'.$static_page->sub_image_home ):(file_exists($static_page->sub_image_home)?asset($static_page->sub_image_home):asset('admin/images/img-upload-placeholder.jpg'))  }}"
                                         class="preview-img" >

                                    <label class="custom-file">
                                        <input type="file" id="sub_image_home"
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

                            @endif

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>@lang('admin.content_ar'):</label>
                                        <textarea class="form-control ckeditor force-en-on-ar"
                                                  name="descr_ar"  id="descr_ar" >{!!$static_page->desc_ar == null ? old('desc_ar') : $static_page->desc_ar!!}</textarea>

                                        <div class="alert alert-danger mg-t-20" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-close alert-icon tx-32"></i>
                                                <span></span>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>@lang('admin.content_en'):</label>
                                        <textarea class="form-control ckeditor force-en-on-ar"
                                                  name="descr_en"  id="descr_en" >{!!  $static_page->desc_en == null ? old('desc_en') : $static_page->desc_en!!}</textarea>


                                    </div>
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


        <script type="text/javascript" src="{{ URL::asset('update.js') }}"></script>update.js  <script type="text/javascript" src="{{ URL::asset('admin/plugins/ckeditor/ckeditor.js') }}"></script>




    @endpush

@endsection
