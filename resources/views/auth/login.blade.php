@extends('layouts.app')

@section('content')
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url({{ asset('images/bg-1.jpg') }});">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                @include('partials.login.logo')
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">{{ __("Iniciar sesión como administrador") }}</h3>
                    </div>
                    <form class="m-login__form m-form"  method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group m-form__group">
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} m-input" type="text" value="{{ old('email') }}" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} m-input m-login__form-input--last" type="password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--light">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recuérdame') }}
                                    <span></span>
                                </label>
                            </div>
                            <div class="col m--align-right m-login__form-right">
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">{{ __('¿Ha olvidado la contraseña?') }}</a>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">{{ __("Iniciar sesión") }}</button>
                        </div>
                    </form>
                </div>
                @include('partials.login.forgetpassword')
            </div>
        </div>
    </div>
</div>
@endsection
