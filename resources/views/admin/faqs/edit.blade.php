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
                                                                href="{{ route('admin.faqs.index') }}">@lang('local.static-pages')</a>
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


                        <form class="needs-validation" novalidate="" method="post" id="update-faqs-form">
                            @csrf()
                            
                            <div class="form-group">

                                <label class="form-label" for="question_ar"> <span class="tx-danger">*</span>
                                    @lang('admin.question_ar')</label>
                                <input type="text" id="question_ar" class="form-control" name="question_ar" placeholder=" @lang('admin.question_ar')" value="{{$faqs->question_ar}}"
                                       aria-label=" @lang('admin.question_ar')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="question_en"> <span class="tx-danger">*</span>
                                    @lang('admin.question_en')</label>
                                <input type="text" id="question_en" class="form-control" name="question_en" placeholder=" @lang('admin.question_en')" value="{{$faqs->question_en}}"
                                       aria-label=" @lang('admin.question_en')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="answer_en"> <span class="tx-danger">*</span>
                                    @lang('admin.answer_en')</label>
                                <input type="text" id="answer_en" class="form-control" name="answer_en" placeholder=" @lang('admin.answer_en')" value="{{$faqs->answer_en}}"
                                       aria-label=" @lang('admin.answer_en')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">

                                <label class="form-label" for="answer_ar"> <span class="tx-danger">*</span>
                                    @lang('admin.answer_ar')</label>
                                <input type="text" id="answer_ar" class="form-control" name="answer_ar" placeholder=" @lang('admin.answer_ar')" value="{{$faqs->answer_ar}}"
                                       aria-label=" @lang('admin.answer_ar')" aria-describedby="basic-addon-name" required="">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
        @if(App::isLocale('ar'))
            <!--arabic-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js">
            </script>
        @endif


        @if(isset($faqs))
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/faqs/edit.js') }}"></script>

        @else
        <script type="text/javascript" src="{{ URL::asset('admin/Forms/faqs/create.js') }}"></script>
@endif

    @endpush

@endsection
