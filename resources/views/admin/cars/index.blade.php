@extends('admin.layout.app')

@section('title', __('local.cars'))

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
                                                <h2 class="content-header-title float-left mb-0">@lang('local.cars')</h2>
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

                                    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                        <div class="form-group breadcrumb-right">

                                            <a href="{{route('admin.cars.create')}}" class="btn btn-icon hide-arrow btn-primary" >
                                                <i data-feather="plus"></i>
                                            </a>


                                        </div>
                                    </div>



                                </div>
                            </div>


                            <div class="table-responsive">
                                <table class="table zero-configuration" id="car-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('local.id')</th>
                                        <th>@lang('local.name')</th>
                                        <th>@lang('local.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($cars as $car)

                                        <tr data-id="{{ $car->id }}" class="row-with-img">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{app()->isLocale('en')?$car->name_en:$car->name_ar}}</td>
                                            <td>
                                                <a
                                                        href="{{route('admin.cars.edit',  $car->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                         height="14" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-edit-2 mr-50">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                    </svg>
                                                </a>

                                                <a class="table-action-delete" data-user-id="{{$car->id}}"
                                                   href="javascript:void(0);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                         height="14" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-trash mr-50">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>


                                <div id="delete-car" class="modal fade">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content bd-0 tx-14">
                                            <div class="modal-header bg-danger pd-y-15 pd-x-25">
                                                <h6 class="tx-14 mg-b-0 header-title"><i
                                                            class="fa fa-trash mg-r-10"></i>@lang('modals.delete_title', ['title' => __('local.car')])
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="delete-car-form">
                                                @csrf
                                                <div class="modal-body pd-25">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="mg-b-10 tx-16 tx-gray tx-mont">@lang('modals.delete_all_descr', ['title' => __('local.car')])</p>
                                                            <p class="mg-b-0 tx-16 tx-danger tx-mont delete-msg force-en-on-ar"></p>
                                                            @isset($warning)
                                                                <div class="alert alert-warning mg-t-20 mg-b-0"
                                                                     role="alert">
                                                                    <div class="d-flex align-items-center justify-content-start">
                                                                        <i class="icon ion-alert-circled alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                                                        <span>@lang($warning)</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12 processing-div">
                                                            <div class="alert alert-info mg-t-20" role="alert">
                                                                <div class="d-flex align-items-center justify-content-start">
                                                                    <div class="sk-double-bounce mg-0 mg-r-15">
                                                                        <div class="sk-child sk-double-bounce1 bg-white-800"></div>
                                                                        <div class="sk-child sk-double-bounce2 bg-white-800"></div>
                                                                    </div>
                                                                    <span>@lang('modals.deleting_please_wait')</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12 errors-div">
                                                            <div class="alert alert-danger mg-t-20 mg-b-0" role="alert">
                                                                <div class="d-flex align-items-center justify-content-start">
                                                                    <i class="icon ion-ios-close alert-icon tx-32"></i>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12 error-div">
                                                            <div class="alert alert-danger alert-bordered pd-y-20 mg-t-20 mg-b-0"
                                                                 role="alert">
                                                                <div class="d-flex align-items-center justify-content-start">
                                                                    <i class="icon ion-ios-close alert-icon tx-52 tx-danger mg-r-20"></i>
                                                                    <div>
                                                                        <h5 class="mg-b-2 tx-danger">@lang('errors.general_error_title')</h5>
                                                                        <p class="mg-b-0 tx-gray">@lang('errors.general_error_description')</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                                                        <i class="fa fa-trash mg-r-10"></i>@lang('admin.delete')
                                                    </button>

                                                    <button class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                                                            data-dismiss="modal"><i
                                                                class="fa fa-times mg-r-10"></i>@lang('admin.close')
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @push('js')

        <script type="text/javascript" src="{{ asset('admin/Forms/car/index.js') }}"></script>

    @endpush


@endsection
