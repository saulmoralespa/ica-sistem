<li class="m-menu__item m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="false">
    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
        <span class="m-menu__item-here"></span>
        <i class="m-menu__link-icon fas fa-dollar-sign"></i>
        <span class="m-menu__link-text">{{ __("Costos") }}</span>
        <i class="m-menu__hor-arrow la la-angle-down"></i>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
        <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 72.5px;"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="false">
                <a href="{{ route('costs.enrollments') }}" class="m-menu__link" title="{{ __("Agregar, editar, eliminar matrículas") }}">
                    <i class="m-menu__link-icon fas fa-ticket-alt"></i>
                    <span class="m-menu__link-text">{{ __("Costos de matrículas") }}</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                    <i class="m-menu__link-icon flaticon-chat-1"></i>
                    <span class="m-menu__link-text">Customer Feedbacks</span>
                </a>
            </li>
        </ul>
    </div>
</li>