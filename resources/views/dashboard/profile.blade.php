@extends('layouts.app')
@section('title')
{{ config('app.name', 'Laravel') }} | Mi perfil
@endsection
@section('content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
    @include('partials.header')
    @include('partials.leftaside')

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">

                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title ">{{ __("Su perfil") }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    @include('partials.profile.editcontent')
                </div>
            </div>
        </div>
        <!-- end:: Body -->
        @include('partials.footer')
    </div>

    <!-- end:: Page -->

    {{--@include('partials.quicksidebar')--}}

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->
@endsection