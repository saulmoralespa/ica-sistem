@extends('layouts.app')

@section('content')
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--2 m-login-2--skin-1 m-login--forget-password" id="m_login" style="background-image: url({{ asset('images/bg-1.jpg') }});">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-login__container">
                    @include('partials.login.logo')
                    @include('partials.login.forgetpassword')
                </div>
            </div>
        </div>
    </div>
@endsection