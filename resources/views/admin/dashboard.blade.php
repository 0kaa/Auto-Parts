@extends('admin.layout.app')
@section('title',trans('local.dashboard'))
@section('description', trans('admin.home_description'))
@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">


            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('local.statistics') }}</h4>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <a href="{{ route('admin.users.index') }}" class="text-info">
                                                <i data-feather="users" class="avatar-icon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $users }}</h4>
                                        <p class="card-text font-small-3 mb-0">{{ __('admin.users') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <div class="avatar bg-light-danger mr-2">
                                        <div class="avatar-content">
                                            <a href="{{ route('admin.orders.index') }}" class="text-danger">
                                                <i data-feather="box" class="avatar-icon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $orders }}</h4>
                                        <p class="card-text font-small-3 mb-0">{{ __('local.orders') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <div class="avatar bg-light-warning mr-2">
                                        <div class="avatar-content">
                                            <a href="{{ route('admin.custom_orders.index') }}" class="text-warning">
                                                <i data-feather="box" class="avatar-icon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $custom_orders }}</h4>
                                        <p class="card-text font-small-3 mb-0">{{ __('local.custom_orders') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>

    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection
