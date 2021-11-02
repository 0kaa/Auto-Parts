@extends('website.layout.app')
@section('pageTitle' , trans('admin.website'))

@section('pageSubTitle' ,  trans('local.register'))

@section('shortcut_icon' , asset('website/images/logo.png'))

@section('content_header')

    <div class="bannr_header" style="background-image: url({{asset('website/images/banner.png')}});">
        <div class="caption">
            <h2>   {{ trans('local.register') }}  </h2>
            <p><a href="{{route('website.home')}}"> {{trans('local.home')}} </a> -  <a href="#"> {{trans('local.register')}} </a></p>
        </div>
    </div>

@endsection
@section('content')



<!-- start regester =======
==============
======-->
<div class="regester">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-regester">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="dd">  
                              <div class="sub-tab-regester">
                                  <img src="{{ url('website') }}/images/gear.png" alt="">
                                  <span>{{ __('local.Personal data') }}</span>
                              </div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="dd">
                            <div class="sub-tab-regester">
                                <img src="{{ url('website') }}/images/gear.png" alt="">
                                <span>{{ __('local.Company Data') }}</span>
                            </div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="messages-tab">
                            <div class="sub-tab-regester">
                                <img src="{{ url('website') }}/images/gear.png" alt="">
                                <span>{{ __('local.the registration is done') }}</span>
                            </div>
                            </a>
                            
                        </li>
                      
                      </ul>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="sub-regester">  
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <!-- start tap form 1 -->
                           <form action="" id="register">
                               <div class="form_sub-regester">
                                  <h2> {{ __('local.Please fill in the following information:') }}   :</h2>
                                  <div class="input-sub-regester">
                                      <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('local.Username (must be in English)') }}">
                                        <div class="alert alert-danger mg-t-20" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-close alert-icon tx-32"></i>
                                                <span></span>
                                            </div>
                                        </div>                                      
                                  </div>

                                    <div class="input-sub-regester">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('local.password') }}">
                                        <div class="alert alert-danger mg-t-20" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-close alert-icon tx-32"></i>
                                                <span></span>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="input-sub-regester">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="{{ __('local.confirm password') }}">
                                        <div class="alert alert-danger mg-t-20" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-close alert-icon tx-32"></i>
                                                <span></span>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="input-sub-regester">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('local.email') }}">
                                        <div class="alert alert-danger mg-t-20" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-close alert-icon tx-32"></i>
                                                <span></span>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="input-sub-regester">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="{{ __('local.phone') }}">
                                        <div class="alert alert-danger mg-t-20" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-close alert-icon tx-32"></i>
                                                <span></span>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="btn-tab">
                                        <button type="submit" class="ctm-btn" id="send-code"> {{ __('local.prev') }}</button>
                                    </div>
                               </div>
                           </form>
                        <!-- end tap form 1 -->
                       </div>

                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="#" id="comapny_register" onsubmit="return false">

                                <input type="hidden" name="user_id" id="user_id" value="no">

                                <div class="form_sub-regester">
                                    <h2> {{ __('local.Your company data') }}  :</h2>
                                    <div class="input-sub-regester">
                                        <select class="form-select form-control" id="get_type" data-action="{{ route('website.get.activity.types') }}" name="get_type" aria-label="Default select example" required>

                                            <option selected value="">{{ __('local.Activity type') }}  </option>

                                            @foreach($activities_types as $activities_type)

                                                <option value="{{ $activities_type->id }}" data-type="{{ $activities_type->type }}"> {{ $activities_type->name }} </option>

                                            @endforeach

                                        </select> 
                                    </div>

                                    <div id="get-all-input"></div>
                                    
                                    <div class="btn-tab">
                                        
                                        <button class="ctm-btn" id="done-register"> {{ __('local.prev') }} </button>
                                    
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            <div class="done_register">
                                <div class="img_done_register">
                                    <img src="images/icon.png" alt="">
                                </div>
                                <h2>{{ __('local.successfully registered') }}</h2>
                                <a href="{{ route('website.home') }}" class="ctm-btn"> {{ __('local.Back to main') }}  <i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end  regester =====
==============
=====  -->








<!--start register-model -->
<div class="modal fade" id="register-modal">
    <div class="modal-dialog modal-dialog-centered big-modal">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">

                <form action="" id="form-active-code" class="needs-validation" novalidate>

                    <div class="register_sub_modal"> 
                        <h2>{{ __('local.code_verify') }}</h2>
                        <p id="text-alert">{{ __('local.text_active_code') }}</p>

                        <input type="hidden" name="phone_active" id="phone_active">
                    
                        <input type="number" name="code" id="code" class="form-control" required placeholder="{{ __('local.verify_code') }}" >
                        <div> {{ __('local.not_send_code') }}  <a href="" id="resend_code" data-action="{{ route('website.resend.code') }}">{{ __('local.relpy_send') }}</a></div>

                        <button type="submit" class="ctm-btn" id="active-code"> {{ __('local.prev') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>




    @push('class_footer')
        <?php
        echo  'class="footer1" ';
        ?>
    @endpush

    @push('footer_pages')
        <div class="col-lg-12">
            <div class="logo-footer">
                <img src="{{asset('website/images/logo fff.png')}}" alt="">
            </div>
        </div>
    @endpush
@endsection

@section('scripts')
    <script src="{{ url('website') }}/js/map.js"></script>

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language=<?php echo e('ar'); ?>"
    defer></script> -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    @if(App::isLocale('ar'))
        <!--arabic-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js">
        </script>
    @endif
    <script src="{{asset('website/forms/register.js')}}"></script>
    @endsection
