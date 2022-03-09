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
                                                <h2 class="content-header-title float-left mb-0">@lang('admin.users')</h2>
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
                                        <th>@lang('local.order_number')</th>
                                        <th>@lang('local.order_ship_name')</th>
                                        <th>@lang('local.order_ship_phone')</th>
                                        <th>@lang('local.order_ship_address')</th>
                                        <th>@lang('local.total_amount')</th>
                                        <th>@lang('local.user')</th>
                                        <th>@lang('local.seller')</th>
                                        <th>@lang('local.shipping')</th>
                                        <th>@lang('local.payment')</th>
                                        <th>@lang('local.order_status')</th>
                                        <th>@lang('local.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($orders as $order)

                                        <tr data-id="{{ $order->id }}" class="row-with-img">
                                            <td>{{$order->order_number}}</td>
                                            <td>{{$order->order_ship_name}}</td>
                                            <td>{{$order->order_ship_phone}}</td>
                                            <td>{{$order->order_ship_address}}</td>
                                            <td>{{$order->total_amount}}</td>
                                            <td>{{$order->user->name}}</td>
                                            <td>{{$order->seller->name}}</td>
                                            <td>{{$order->shipping->shipping_name}}</td>
                                            <td>{{$order->payment->name}}</td>
                                            <td>{{$order->order_status->name}}</td>
                                            <td>
                                                {{-- <a class="dropdown-item"
                                                   href="{{route('admin.users.edit',  $user->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                         height="14" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-edit-2 mr-50">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                    </svg>
                                                    <span>@lang('local.edit')</span>
                                                </a>

                                                @if($user->type!='admin')
                                                <a class="dropdown-item table-action-not-delete-user" data-user-id="{{$user->id}}"
                                                   href="javascript:void(0);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                         height="14" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-trash mr-50">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                    <span>@lang('admin.delete')</span>
                                                </a>
                                                    @endif --}}

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
