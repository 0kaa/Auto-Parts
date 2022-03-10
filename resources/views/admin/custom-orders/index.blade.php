@extends('admin.layout.app')

@section('title', __('admin.users'))

@section('content')

    <section id="basic-datatable">
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
                                                                    href="{{route('admin.dashboard')}}">@lang('local.dashboard')</a>
                                                        </li>

                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                        <div class="form-group breadcrumb-right">

                                            <a href="{{route('admin.users.create')}}" class="btn btn-icon hide-arrow btn-primary" >
                                                <i data-feather="plus"></i>
                                            </a>


                                        </div>
                                    </div> --}}



                                </div>
                            </div>


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
                                        <th>@lang('local.sub_activity')</th>
                                        <th>@lang('local.user')</th>
                                        <th>@lang('local.seller')</th>
                                        <th>@lang('local.car')</th>
                                        <th>@lang('local.shipping')</th>
                                        <th>@lang('local.payment')</th>
                                        <th>@lang('local.order_status')</th>
                                        <th>@lang('local.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($custom_orders as $order)

                                        <tr data-id="{{ $order->id }}" class="row-with-img">
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->piece_name}}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$order->piece_image) }}" alt="">
                                            </td>
                                            <td>{{$order->piece_description ? $order->piece_description : '-'}}</td>
                                            <td>{{$order->piece_price}}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$order->form_image) }}" alt="">
                                            </td>
                                            <td>{{$order->note}}</td>
                                            <td>{{$order->payment_url}}</td>
                                            <td>{{$order->quantity}}</td>
                                            <td>{{$order->activityType->name}}</td>
                                            <td>{{$order->subActivity->name}}</td>
                                            <td>{{$order->sub_sub_activity_id ? $order->subActivity->name : '-'}}</td>
                                            <td>{{$order->user->name}}</td>
                                            <td>{{$order->seller_id ? $order->seller->name : '-'}}</td>
                                            <td>{{$order->car->name}}</td>
                                            <td>{{$order->shipping->shipping_name}}</td>
                                            <td>{{$order->payment->name}}</td>
                                            <td>{{$order->order_status->name}}</td>
                                            <td>
                                                <a class="dropdown-item"
                                                   href="{{route('admin.orders.edit',  $order->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                         height="14" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-edit-2 mr-50">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
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

    </section>



@endsection
