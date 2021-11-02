@extends('admin.layout.app')

@section('title',trans('local.settings'))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.settings')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                                href="{{ route('admin.dashboard') }}">@lang('local.dashboard')</a>
                                                    </li>



                                                    <li class="breadcrumb-item active">@lang('local.settings')
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form action="{{ route('admin.settings.store') }}" method="post" id="form-settings" enctype="multipart/form-data">
                            @csrf
                            @foreach($settings as  $setting)

                                @if($setting->type == 'text')
                                    <div class="form-group">

                                        <label class="form-label" for="{{ $setting->key }}"> <span class="tx-danger">*</span> {{ __($setting->neckname)}}</label>
                                        <input type="text" id="{{ $setting->key }}" name="{{ $setting->key }}" class="form-control"  value="{{ $setting->value }}" required=""> 

                                    </div>
                                @endif
                                
                                @if($setting->type == 'textarea')
                                <div class="form-group">
                                    
                                    <label class="form-label" for="{{ $setting->key }}"> <span class="tx-danger">*</span> {{ __($setting->neckname)}}</label>
                                    <textarea id="{{ $setting->key }}" name="{{ $setting->key }}" class="form-control" required="">{{ $setting->value }}</textarea>
                                    
                                </div>
                                @endif

                                @if($setting->type == 'address')
                                    <div class="form-group">
                                        
                                        <input type="text" id="{{ $setting->key }}" name="{{ $setting->key }}" class="form-control"  value="{{ $setting->value }}" required=""> 
                                        <div id="map"></div>
                                    </div>
                                @endif

                                @if($setting->type == 'hidden')
                                    <div class="form-group">

                                        <input type="hidden" id="{{ $setting->key }}" name="{{ $setting->key }}" class="form-control"  value="{{ $setting->value }}" required=""> 

                                    </div>
                                @endif

                                @if($setting->type == 'email')
                                    <div class="form-group">

                                        <label class="form-label" for="{{ $setting->key }}"> <span class="tx-danger">*</span> {{ __($setting->neckname)}}</label>
                                        <input type="email" id="{{ $setting->key }}" name="{{ $setting->key }}" class="form-control"  value="{{ $setting->value }}" required=""> 

                                    </div>
                                @endif  

                                @if($setting->type == 'number')
                                    <div class="form-group">

                                        <label class="form-label" for="{{ $setting->key }}"> <span class="tx-danger">*</span> {{ __($setting->neckname)}}</label>
                                        <input type="number" id="{{ $setting->key }}" name="{{ $setting->key }}" class="form-control"  value="{{ $setting->value }}" required=""> 

                                    </div>
                                @endif  

                                @if($setting->type == 'file')
                                    <div class="form-group">

                                        <label class="form-label" for="{{ $setting->key }}"> <span class="tx-danger">*</span> {{ __($setting->neckname)}}</label>
                                        <input type="file" id="{{ $setting->key }}" name="{{ $setting->key }}" class="form-control image"  required=""> 

                                    </div>
                                @endif                                

                            @endforeach

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">@lang('admin.submit')</button>
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
        <script type="text/javascript" src="{{ URL::asset('update.js') }}"></script>
         <script type="text/javascript" src="{{ URL::asset('admin/plugins/ckeditor/ckeditor.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('admin/Forms/settings/map.js') }}"></script>

        @if(App::isLocale('ar'))
        <!--arabic-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js">
            </script>
        @endif
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language=<?php echo e('ar'); ?>"
    defer></script>

    @endpush

@endsection
