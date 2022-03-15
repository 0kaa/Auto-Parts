@extends('admin.layout.app')

@section('title', trans('admin.add_new', ['field' => __('local.user')]))
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


                        <form class="needs-validation" novalidate="" id="update-order-form">

                            <div class="form-group">

                                <label class="form-label" for="order_number"> <span class="tx-danger">*</span>
                                    @lang('local.order_number')</label>
                                <input
                                    type="text"
                                    id="order_number"
                                    class="form-control"
                                    placeholder=" @lang('local.order_number')"
                                    aria-label=" @lang('local.order_number')"
                                    value="{{ $order->order_number }}"
                                    aria-describedby="basic-addon-order_number"
                                    required=""
                                >
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="form-label" for="order_ship_name"> <span class="tx-danger">*</span>
                                    @lang('local.order_ship_name')</label>
                                <input
                                    type="text"
                                    id="order_ship_name"
                                    class="form-control"
                                    placeholder=" @lang('local.order_ship_name')"
                                    aria-label=" @lang('local.order_ship_name')"
                                    value="{{ $order->order_ship_name }}"
                                    aria-describedby="basic-addon-order_ship_name"
                                    required=""
                                >
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="order_ship_phone"> <span class="tx-danger">*</span>
                                    @lang('local.order_ship_phone')</label>
                                <input
                                    type="text"
                                    id="order_ship_phone"
                                    class="form-control"
                                    placeholder=" @lang('local.order_ship_phone')"
                                    aria-label=" @lang('local.order_ship_phone')"
                                    value="{{ $order->order_ship_phone }}"
                                    aria-describedby="basic-addon-order_ship_phone"
                                    required=""
                                >
                                <div class="alert alert-danger mg-t-20" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32"></i>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label" for="order_ship_address"> <span
                                        class="tx-danger">*</span>
                                    @lang('local.order_ship_address')</label>
                                <input
                                    type="text"
                                    id="order_ship_address"
                                    class="form-control"
                                    placeholder=" @lang('local.order_ship_address')"
                                    aria-label=" @lang('local.order_ship_address')"
                                    value="{{ $order->order_ship_address }}"
                                    aria-describedby="basic-addon-order_ship_address"
                                    required=""
                                >
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
                                <select
                                    id="shipping_id"
                                    class="form-control select2-show-search"
                                    placeholder=" @lang('local.shipping')"
                                    aria-label=" @lang('local.shipping')"
                                    aria-describedby="basic-addon-name"
                                    required=""
                                >
                                    @foreach ($shippings as $shipping)
                                        <option
                                            value="{{ $shipping->id }}"
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
                                <select
                                    id="payment_id"
                                    class="form-control select2-show-search"
                                    placeholder=" @lang('local.payment')"
                                    aria-label=" @lang('local.payment')"
                                    aria-describedby="basic-addon-name"
                                    required="">
                                    @foreach ($payments as $payment)
                                        <option
                                            value="{{ $payment->id }}"
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

                                    <label class="form-label" for="payment_url"> <span
                                            class="tx-danger">*</span>
                                        @lang('local.payment_url')</label>
                                    <input
                                        type="text"
                                        id="payment_url"
                                        class="form-control"
                                        placeholder=" @lang('local.payment_url')"
                                        aria-label=" @lang('local.payment_url')"
                                        value="{{ $order->payment_url }}"
                                        aria-describedby="basic-addon-payment_url"
                                        required=""
                                    >
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
                                <select
                                    id="order_status"
                                    class="form-control select2-show-search"
                                    placeholder=" @lang('local.order_status')"
                                    aria-label=" @lang('local.order_status')"
                                    aria-describedby="basic-addon-name"
                                    required="">
                                    @foreach ($order_status as $status)
                                        <option
                                            value="{{ $status->id }}"
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

        <script type="text/javascript" src="{{ URL::asset('admin/Forms/orders/edit.js') }}"></script>
    @endpush

@endsection
