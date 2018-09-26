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
                    <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                        <li class="m-nav__separator m-nav__separator--fit"></li>
                        <li class="m-nav__section m--hide">
                            <span class="m-nav__section-text">Section</span>
                        </li>
                        <li class="m-nav__item">
                            <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                <span class="m-nav__link-title">
															<span class="m-nav__link-wrap">
																<span class="m-nav__link-text">{{ __("Su perfil") }}</span>
																<span class="m-nav__link-badge">
																	<span class="m-badge m-badge--success">2</span>
																</span>
															</span>
														</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-share"></i>
                                <span class="m-nav__link-text">Activity</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                <span class="m-nav__link-text">Messages</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-graphic-2"></i>
                                <span class="m-nav__link-text">Sales</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-time-3"></i>
                                <span class="m-nav__link-text">Events</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                <span class="m-nav__link-text">Support</span>
                            </a>
                        </li>
                    </ul>
                    <div class="m-portlet__body-separator"></div>
                    <div class="m-widget1 m-widget1--paddingless">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Member Profit</h3>
                                    <span class="m-widget1__desc">Awerage Weekly Profit</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand">+$17,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Orders</h3>
                                    <span class="m-widget1__desc">Weekly Customer Orders</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">+1,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Issue Reports</h3>
                                    <span class="m-widget1__desc">System bugs and issues</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-success">-27,49%</span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <form class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10 m--hide">
                                    <div class="alert m-alert m-alert--default" role="alert">
                                        The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ __("Nombre") }}</label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text"  name="nameuser" required>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ __("Correo electrónico") }}</label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="email" name="emailuser" required>
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
                        <h3>Cambiar contraseña</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>