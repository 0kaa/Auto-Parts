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

                                <label class="form-label" for="price"> <span class="tx-danger">*</span>
                                    @lang('local.price')</label>
                                <input type="text" id="price" class="form-control"
                                    placeholder=" @lang('local.price')" aria-label=" @lang('local.price')"
                                    value="{{ $order->price }}" aria-describedby="basic-addon-price"
                                    required="">
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
                                                            href="{{ route('admin.custom_orders.index') }}">@lang('local.custom_orders')</a>
                                                    </li>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- custom order items table --}}
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="contact-us-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('local.piece_name')</th>
                                        <th>@lang('local.piece_image')</th>
                                        <th>@lang('local.piece_desc')</th>
                                        <th>@lang('local.piece_price')</th>
                                        <th>@lang('local.form_image')</th>
                                        <th>@lang('local.note')</th>
                                        <th>@lang('local.payment_url')</th>
                                        <th>@lang('local.quantity')</th>
                                        <th>@lang('local.activity_type')</th>
                                        <th>@lang('local.sub_activity')</th>
                                        <th>@lang('local.sub_sub_activity')</th>
                                        <th>@lang('local.user')</th>
                                        <th>@lang('local.seller')</th>
                                        <th>@lang('local.car')</th>
                                        <th>@lang('local.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($custom_order_items as $order)
                                        <tr data-id="{{ $order->id }}" class="row-with-img">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->piece_name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $order->piece_image) }}" width="100"
                                                    height="100" alt="">
                                            </td>
                                            <td>{{ $order->piece_description ? $order->piece_description : '-' }}</td>
                                            <td>{{ $order->piece_price ? $order->piece_price : '-' }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $order->form_image) }}" width="100"
                                                    height="100" alt="">
                                            </td>
                                            <td>{{ $order->note }}</td>
                                            <td>{{ $order->payment_url ? $order->payment_url : '-' }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->activityType->name }}</td>
                                            <td>{{ $order->subActivity->name }}</td>
                                            <td>{{ $order->sub_sub_activity_id ? $order->subActivity->name : '-' }}</td>
                                            <td>{{ $order->user ? $order->user->name : '' }}</td>
                                            <td>{{ $order->seller_id ? $order->seller->name : '-' }}</td>
                                            <td>{{ $order->car->name }}</td>
                                            <td>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.custom_order_items.edit', $order->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2 mr-50">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                    <span>@lang('local.edit')</span>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>




                        </div>

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
