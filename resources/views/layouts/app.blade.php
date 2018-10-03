<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet">
    @if(auth()->check())
    <link href="{{ asset('css/fullcalendar.bundle.css') }}" rel="stylesheet">
    @endif
    @stack('styles')
</head>
<body @if(auth()->check()) class="m--skin- m-page--loading-enabled m-page--loading m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default" @else class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" @endif>
@if(auth()->check())
<div id="app">
    @yield('content')
</div>
@else
    @yield('content')
@endif
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@if(auth()->check())
<script src="{{ asset('js/dashboard.js') }}"></script>
@else
<script src="{{ asset('js/login.js') }}"></script>
@endif
@stack('scripts')
</body>
</html>
