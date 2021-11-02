<link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}">
<link rel="shortcut icon" href="@yield('shortcut_icon')" />

<link rel="stylesheet" href="{{asset('website/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('website/css/owl.theme.default.min.css')}}">

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('website/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('website/css/style.css')}}">
<link rel="stylesheet" href="{{asset('website/css/responsive.css')}}">
@if(app()->isLocale('en'))
    <link rel="stylesheet" href="{{asset('website/css/en.css')}}">
    @else
    <link rel="stylesheet" href="{{asset('website/css/ar.css')}}">

@endif
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/toastr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"
      type="text/css" />

<style>
    .error{
        color: red;
    }
</style>