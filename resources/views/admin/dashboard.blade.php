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
                        <h4 class="card-title">{{trans('local.Statistics')}}</h4>

                    </div>

                    <div class="card-body statistics-body">
                        <div class="row">

                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0"></h4>
                                        <p class="card-text font-small-3 mb-0">)</p>
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