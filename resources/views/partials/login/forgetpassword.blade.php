<div class="m-login__forget-password">
    <div class="m-login__head">
        <h3 class="m-login__title">{{ __("¿ Olvido la contraseña ?") }}</h3>
        <div class="m-login__desc">{{ __("Ingrese su correo electrónico para restablecer su contraseña") }}:</div>
    </div>
    <form class="m-login__form m-form" method="post" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group m-form__group">
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} m-input" type="email" value="{{ old('email') }}" name="email" id="m_email" placeholder="Email" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="m-login__form-action">
            <button id="m_login_forget_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" type="submit">{{ __("Solicitar") }}</button>&nbsp;&nbsp;
            @if(request()->path() === 'login')
                <button id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">{{ __("Cancelar") }}</button>
            @endif
        </div>
    </form>
</div>