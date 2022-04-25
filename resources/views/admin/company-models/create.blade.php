@extends('admin.layout.app')

@section('title', isset($company_model) ? trans('local.common_edit', ['field' => __('local.company-models')]) :
    trans('admin.add_new', ['field' => __('local.company-models')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.company-models')
                                            </h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                            href="{{ route('admin.dashboard') }}">@lang('admin.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                            href="{{ route('admin.company-models.index') }}">@lang('local.company-models')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">
                                                        @if (isset($company_model))
                                                            @lang('local.common_edit', ['field'
                                                            =>__('local.company-models')])
                                                        @else
                                                            @lang('admin.add_new', ['field' =>
                                                            __('local.company-models')])
                                                        @endif
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate=""
                            id="{{ isset($company_model) ? 'update-company-model-form' : 'create-company-model-form' }}">

                            <div class="form-group">

                                <label class="form-label" for="name"> <span class="tx-danger">*</span>
                                    @lang('local.name')</label>
                                <input type="text" id="name" class="form-control" placeholder=" @lang('local.name')"
                                    aria-label=" @lang('local.name')"
                                    value="{{ isset($company_model) ? $company_model->name : '' }}"
                                    aria-describedby="basic-addon-name" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="company_sector_id"> <span class="tx-danger">*</span>
                                    @lang('local.company-sectors')</label>
                                <select id="company_sector_id" class="form-control select2-show-search"
                                    placeholder=" @lang('local.company-sectors')"
                                    aria-label=" @lang('local.company-sectors')" aria-describedby="basic-addon-name"
                                    required="">
                                    <option value="" readonly="" selected>@lang('admin.select')</option>

                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ isset($company_model) && $company->id == $company_model->company_sector_id ? 'selected' : '' }}>
                                            {{ app()->isLocale('en') ? $company->name_en : $company->name_ar }}
                                        </option>
                                    @endforeach
                                </select>

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

        @if (isset($company_model))
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/company-model/update.js') }}"></script>
        @else
            <script type="text/javascript" src="{{ URL::asset('admin/Forms/company-model/create.js') }}"></script>
        @endif

    @endpush

@endsection
