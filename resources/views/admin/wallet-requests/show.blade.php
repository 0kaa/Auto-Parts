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
                                                                href="{{ route('admin.dashboard') }}">@lang('local.dashboard')</a>
                                                        </li>

                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-8 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ __('local.user_name') }} :
                                            {{ $wallet_request->user->first_name . ' ' . $wallet_request->user->last_name }}
                                        </h4>
                                        <h4 class="card-title">{{ __('local.user_email') }} :
                                            {{ $wallet_request->user->email }}</h4>
                                        <h4 class="card-title">{{ __('local.user_phone') }} :
                                            {{ $wallet_request->user->phone }}</h4>
                                        <h4 class="card-title">{{ __('local.user_address') }} :
                                            {{ $wallet_request->user->address }}</h4>
                                        <h4 class="card-title">{{ __('local.amount') }} :
                                            {{ $wallet_request->amount }}</h4>
                                        <h4 class="card-title">{{ __('local.is_approved') }} :
                                            {{ $wallet_request->is_approved == 1 ? __('local.yes') : __('local.no') }}
                                        </h4>

                                        @if ($wallet_request->is_approved == 0)
                                            <a href="{{ route('admin.wallet-requests.approve', $wallet_request->id) }}" class="btn btn-outline-primary">{{ __('local.approve') }}</a>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



@endsection
