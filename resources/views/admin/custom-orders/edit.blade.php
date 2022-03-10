@extends('admin.layout.app')

@section('title', trans('admin.edit', ['field' => __('local.custom')]))
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
                                            <h2 class="content-header-title float-left mb-0">@lang('local.orders')</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a
                                                            href="{{ route('admin.dashboard') }}">@lang('admin.dashboard')</a>
                                                    </li>

                                                    <li class="breadcrumb-item"><a
                                                            href="{{ route('admin.orders.index') }}">@lang('local.orders')</a>
                                                    </li>

                                                    <li class="breadcrumb-item active">@lang('local.edit_order', ['field' =>
                                                        __('local.user')])
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <form class="needs-validation" novalidate="" id="update-custom-order-form">

                            <div class="form-group">

                                <label class="form-label" for="piece_name"> <span class="tx-danger">*</span>
                                    @lang('local.piece_name')</label>
                                <input type="text" id="piece_name" class="form-control"
                                    placeholder=" @lang('local.piece_name')" aria-label=" @lang('local.piece_name')"
                                    value="{{ $order->piece_name }}" aria-describedby="basic-addon-piece_name"
                                    required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="piece_description"> <span class="tx-danger">*</span>
                                    @lang('local.piece_desc')</label>

                                <textarea name="" id="piece_description" class="form-control"
                                    placeholder=" @lang('local.piece_desc')" aria-label=" @lang('local.piece_desc')"
                                    aria-describedby="basic-addon-piece_description" required="" cols="30" rows="5">
                                                {{ $order->piece_description }}

                                            </textarea>
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="piece_price"> <span class="tx-danger">*</span>
                                    @lang('local.piece_price')</label>
                                <input type="text" id="piece_price" class="form-control"
                                    placeholder=" @lang('local.piece_price')" aria-label=" @lang('local.piece_price')"
                                    value="{{ $order->piece_price }}" aria-describedby="basic-addon-piece_price"
                                    required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="piece_image"> <span class="tx-danger">*</span>
                                    @lang('local.piece_image')</label>

                                    <div class="form-group">
                                        <img class="img-fluid" width="100" height="100" src="@if(isset($order)&&$order->piece_image!=""){{ file_exists('storage/'.$order->piece_image)?asset('storage/'.$order->piece_image ):(file_exists('website/'.$order->piece_image)?asset('website/'.$order->piece_image):asset('admin/images/img-upload-placeholder.jpg')) }}
                                        @else{{asset('admin/images/img-upload-placeholder.jpg')}}@endif"
                                             class="preview-img" >

                                        <label class="custom-file">
                                            <input type="file" id="piece_image"
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

                                <label class="form-label" for="form_image"> <span class="tx-danger">*</span>
                                    @lang('local.form_image')</label>

                                    <div class="form-group">
                                        <img class="img-fluid" width="100" height="100" src="@if(isset($order)&&$order->form_image!=""){{ file_exists('storage/'.$order->form_image)?asset('storage/'.$order->form_image ):(file_exists('website/'.$order->form_image)?asset('website/'.$order->form_image):asset('admin/images/img-upload-placeholder.jpg')) }}
                                        @else{{asset('admin/images/img-upload-placeholder.jpg')}}@endif"
                                             class="preview-img" >

                                        <label class="custom-file">
                                            <input type="file" id="form_image"
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

                                <label class="form-label" for="note"> <span class="tx-danger">*</span>
                                    @lang('local.note')</label>

                                <textarea name="" id="note" class="form-control" placeholder=" @lang('local.note')"
                                    aria-label=" @lang('local.note')" aria-describedby="basic-addon-note" required=""
                                    cols="30" rows="5">
                                                {{ $order->note }}
                                            </textarea>
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="quantity"> <span class="tx-danger">*</span>
                                    @lang('local.quantity')</label>
                                <input type="text" id="quantity" class="form-control"
                                    placeholder=" @lang('local.quantity')" aria-label=" @lang('local.quantity')"
                                    value="{{ $order->quantity }}" aria-describedby="basic-addon-quantity" required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="activity_type_id"> <span class="tx-danger">*</span>
                                    @lang('local.activity_type')</label>
                                <select id="activity_type_id" class="form-control select2-show-search"
                                    data-action="{{ route('admin.get_activity') }}"
                                    placeholder=" @lang('local.activity_type')" aria-label=" @lang('local.activity_type')"
                                    aria-describedby="basic-addon-name" required="">
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity->id }}"
                                            {{ $order->activity_type_id == $activity->id ? 'selected' : '' }}>
                                            {{ $activity->name }}
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


                            <div class="form-group" id="append_sub_activity">
                                <label class="form-label" for="sub_activity_id"> <span class="tx-danger">*</span>
                                    @lang('local.sub_activity')</label>
                                <select id="sub_activity_id" class="form-control select2-show-search"
                                    data-action="{{ route('admin.get_sub_activity') }}"
                                    placeholder=" @lang('local.sub_activity')" aria-label=" @lang('local.sub_activity')"
                                    aria-describedby="basic-addon-name" required="">
                                    @foreach ($sub_activities as $sub_activity)
                                        <option value="{{ $sub_activity->id }}"
                                            {{ $order->sub_activity_id == $sub_activity->id ? 'selected' : '' }}>
                                            {{ $sub_activity->name }}
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

                            <div class="form-group" id="append_sub_sub_activity">
                                @if ($order->activity_type_id == 6)

                                    <label class="form-label" for="sub_sub_activity_id"> <span
                                            class="tx-danger">*</span>
                                        @lang('local.sub_activity')</label>
                                    <select id="sub_sub_activity_id" class="form-control select2-show-search"
                                        placeholder=" @lang('local.sub_sub_activity')"
                                        aria-label=" @lang('local.sub_sub_activity')" aria-describedby="basic-addon-name"
                                        required="">
                                        @foreach ($sub_sub_activities as $sub_activity)
                                            <option value="{{ $sub_activity->id }}"
                                                {{ $order->sub_sub_activity_id == $sub_activity->id ? 'selected' : '' }}>
                                                {{ $sub_activity->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <div class="alert alert-danger mg-t-20" role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-32"></i>
                                            <span></span>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="car_id"> <span class="tx-danger">*</span>
                                    @lang('local.payment')</label>
                                <select id="car_id" class="form-control select2-show-search"
                                    placeholder=" @lang('local.car')" aria-label=" @lang('local.car')"
                                    aria-describedby="basic-addon-name" required="">
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}"
                                            {{ $order->car_id == $car->id ? 'selected' : '' }}>
                                            {{ $car->name }}
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


                            <div class="form-group">

                                <label class="form-label" for="shipping_id"> <span class="tx-danger">*</span>
                                    @lang('local.shipping')</label>
                                <select id="shipping_id" class="form-control select2-show-search"
                                    placeholder=" @lang('local.shipping')" aria-label=" @lang('local.shipping')"
                                    aria-describedby="basic-addon-name" required="">
                                    @foreach ($shippings as $shipping)
                                        <option value="{{ $shipping->id }}"
                                            {{ $order->shipping_id == $shipping->id ? 'selected' : '' }}>
                                            {{ $shipping->shipping_name }}
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


                            <div class="form-group">

                                <label class="form-label" for="payment_id"> <span class="tx-danger">*</span>
                                    @lang('local.payment')</label>
                                <select id="payment_id" class="form-control select2-show-search"
                                    placeholder=" @lang('local.payment')" aria-label=" @lang('local.payment')"
                                    aria-describedby="basic-addon-name" required="">
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}"
                                            {{ $order->payment_id == $payment->id ? 'selected' : '' }}>
                                            {{ $payment->name }}
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



                            <div class="form-group">

                                <label class="form-label" for="payment_url"> <span class="tx-danger">*</span>
                                    @lang('local.payment_url')</label>
                                <input type="text" id="payment_url" class="form-control"
                                    placeholder=" @lang('local.payment_url')" aria-label=" @lang('local.payment_url')"
                                    value="{{ $order->payment_url }}" aria-describedby="basic-addon-payment_url"
                                    required="">
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="order_status"> <span class="tx-danger">*</span>
                                    @lang('local.order_status')</label>
                                <select id="order_status" class="form-control select2-show-search"
                                    placeholder=" @lang('local.order_status')" aria-label=" @lang('local.order_status')"
                                    aria-describedby="basic-addon-name" required="">
                                    @foreach ($order_status as $status)
                                        <option value="{{ $status->id }}"
                                            {{ $order->order_status_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
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
        {{-- <script type="text/javascript" src="{{ URL::asset('admin/Forms/Maps/create.js') }}"></script> --}}

        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs"
                async></script>

        <script type="text/javascript" src="{{ URL::asset('admin/Forms/custom-orders/edit.js') }}"></script>
    @endpush

@endsection
