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
                                                <h2 class="content-header-title float-left mb-0">@lang('local.wallet_requests')</h2>
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

                                </div>
                            </div>


                            <div class="table-responsive">
                                <table class="table zero-configuration" id="contact-us-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('local.user_name')</th>
                                        <th>@lang('local.amount')</th>
                                        <th>@lang('local.is_approved')</th>
                                        <th>@lang('local.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($wallet_requests as $request)

                                        <tr data-id="{{ $request->id }}" class="row-with-img">
                                            <td>{{$request->user->name}}</td>
                                            <td>{{$request->amount}}</td>
                                            <td>{{$request->is_approved == 1 ? __('local.yes') : __('local.no')}}</td>
                                            <td>
                                                <a class="dropdown-item"
                                                   href="{{route('admin.wallet-requests.edit',  $request->id)}}">
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
