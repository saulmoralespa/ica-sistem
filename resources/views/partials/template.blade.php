@extends('layouts.app')
@section('content')
    @include('partials.pageloader')
    <div class="m-grid m-grid--hor m-grid--root m-page">
    @include('partials.header')
    @include('partials.leftaside')
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    @yield('subheader')
                    @yield('bodycontent')
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
    {{--@include('partials.quicksidebar')--}}

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->
@endsection