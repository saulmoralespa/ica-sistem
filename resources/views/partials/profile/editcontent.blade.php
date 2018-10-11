<div class="m-content">
    <div class="row">
        <div class="col-lg-4">
            <div class="m-portlet m-portlet--full-height  ">
                <div class="m-portlet__body">
                    <div class="m-card-profile">
                        <div class="m-card-profile__title m--hide">
                            {{ __("Su perfil") }}
                        </div>
                        <div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
                                <img src="assets/app/media/img/users/user4.jpg" alt="" />
                            </div>
                        </div>
                        <div class="m-card-profile__details">
                            <span class="m-card-profile__name">{{ auth()->user()->name }}</span>
                            <a href="" class="m-card-profile__email m-link">{{ auth()->user()->email }}</a>
                        </div>
                    </div>
                    @include('partials.profile.portlet')
                    <div class="m-portlet__body-separator"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                    <i class="flaticon-share m--hide"></i>
                                    {{ __("Datos") }}
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                    {{ __("Contraseña") }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="m_user_profile_tab_1">
                        <form class="m-form m-form--fit m-form--label-align-right" id="data-profile">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10 alert-user m--hide">
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ __("Nombre") }}</label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text"  name="name" value="{{ auth()->user()->name }}" required>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ __("Correo electrónico") }}</label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="email" name="email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-7">
                                            <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">{{ __("Guardar cambios") }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane " id="m_user_profile_tab_2">
                        <form class="m-form m-form--fit m-form--label-align-right" id="password-user">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10 alert-user m--hide">
                                </div>
                                <p class="h5">{{ __("Después del cambio va a ser redirigido a iniciar sesión con su nueva contraseña") }}</p>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ __("Nueva contraseña") }}</label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="password"  name="password" required>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ __("Repita la contraseña") }}</label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="password" name="repeatpassword" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-7">
                                            <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">{{ __("Cambiar contraseña") }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>