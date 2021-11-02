<!DOCTYPE html>

<html id="lang" lang="{{ App::getLocale() }}">

<head>
    <title>  @yield('pageTitle')| @yield('pageSubTitle') </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="welcoma">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- *******************************
    **********************
    ***************
    -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    @include('website.layout.styles')

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#F36649">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#F36649">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#F36649">
    <meta name="apple-mobile-web-app-capable" content="yes">
</head>
<body>

<!-- start header ===============
===========================
================ -->


@yield('loading')

@include('website.layout.header')

<!-- end header ===============
===========================
================ -->

@yield('content')

@include('website.layout.footer')

@include('website.layout.scripts')

</body>
<!-- end-body
=================== -->

</html>