@extends('admin.layout.app')

@section('title',trans('local.common_edit', ['field' =>__('local.shippings')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.shippings')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('local.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.shippings.index') }}">@lang('local.shippings')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@lang('local.common_edit', ['field' =>
                                                        __('local.shippings')])
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate="" method="post" id="update-shippings-form">
                            @csrf()
                            
                            <div class="form-group">

                                <label class="form-label" for="shipping_name_ar"> <span class="tx-danger">*</span>
                                    @lang('admin.shipping_name_ar')</label>
                                <input type="text" id="shipping_name_ar" class="form-control" name="shipping_name_ar" placeholder=" @lang('admin.shipping_name_ar')" value="{{$shipping->shipping_name_ar}}"
                                       aria-label=" @lang('admin.shipping_name_ar')" aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="shipping_name_en"> <span class="tx-danger">*</span>
                                    @lang('admin.shipping_name_en')</label>
                                <input type="text" id="shipping_name_en" class="form-control" name="shipping_name_en" placeholder=" @lang('admin.shipping_name_en')" value="{{$shipping->shipping_name_en}}"
                                       aria-label=" @lang('admin.shipping_name_en')" aria-describedby="basic-addon-name" required="">
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


        @if(isset($shipping))
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/shippings/edit.js') }}"></script>

        @else
        <script type="text/javascript" src="{{ URL::asset('admin/Forms/shippings/create.js') }}"></script>
@endif

    @endpush

@endsection
