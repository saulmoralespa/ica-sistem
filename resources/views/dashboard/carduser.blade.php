<li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
    <a href="#" class="m-nav__link m-dropdown__toggle">
        <span class="m-topbar__username m--hidden-mobile">{{ auth()->user()->username }}</span>
        <span class="m-topbar__userpic">
													{{--<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="" />--}}
												</span>
        <span class="m-nav__link-icon m-topbar__usericon  m--hide">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-user-ok"></i>
													</span>
												</span>
    </a>
    <div class="m-dropdown__wrapper">
        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        <div class="m-dropdown__inner">
            <div class="m-dropdown__header m--align-center">
                <div class="m-card-user m-card-user--skin-light">
                    <div class="m-card-user__pic">
                        {{--<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />--}}
                    </div>
                    <div class="m-card-user__details">
                        <span class="m-card-user__name m--font-weight-500">{{ auth()->user()->name }}</span>
                        <a href="{{ route('profile') }}" class="m-card-user__email m--font-weight-300 m-link">{{ auth()->user()->email }}</a>
                    </div>
                </div>
            </div>
            <div class="m-dropdown__body">
                <div class="m-dropdown__content">
                    <ul class="m-nav m-nav--skin-light">
                        <li class="m-nav__section m--hide">
                            <span class="m-nav__section-text">Section</span>
                        </li>
                        <li class="m-nav__item">
                            <a href="{{ route('profile')  }}" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                <span class="m-nav__link-title">
                                    <span class="m-nav__link-wrap">
                                        <span class="m-nav__link-text">{{ __("Mi perfil") }}</span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__separator m-nav__separator--fit">
                        </li>
                        <li class="m-nav__item">
                            <a href="{{ route('logout') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">{{ __("Cerrar sesión") }}</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>