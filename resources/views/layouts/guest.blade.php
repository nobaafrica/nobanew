<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('icons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('icons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('icons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('icons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('icons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('icons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('icons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('icons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('icons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('icons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icons/favicon-16x16.png') }}">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">

        <!-- Styles -->
        {{-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> --}}
        @livewireStyles
        @stack('styles')
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('/assets/css/app.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    </head>
    <body class="font-sans antialiased" data-sidebar="dark">
        {{ $slot }}
    </body>
    <!-- JAVASCRIPT -->
    @livewireScripts
    <script src="{{ ('/assets/libs/jquery/jquery.min.js') }}" defer></script>
    <script src="{{ ('/js/app.js') }}" defer></script>
    <script src="{{ ('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ ('/assets/libs/metismenu/metisMenu.min.js') }}" defer></script>
    <script src="{{ ('/assets/libs/simplebar/simplebar.min.js') }}" defer></script>
    <script src="{{ ('/assets/libs/node-waves/waves.min.js') }}" defer></script>

    <!-- apexcharts -->
    <script src="{{ ('/assets/libs/apexcharts/apexcharts.min.js') }}" defer></script>
    @stack('scripts')
    <!-- App js -->
    <script src="{{ ('/assets/js/app.js') }}" defer></script>
   
</html>
