<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
        <span class="m-menu__item-here"></span>
        <i class="m-menu__link-icon fas fa-money-bill-alt"></i>
        <span class="m-menu__link-text">{{ __("Pagos") }}</span>
        <i class="m-menu__hor-arrow la la-angle-down"></i>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
        <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 72.5px;"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                <a href="{{ route('payments') }}" class="m-menu__link" title="{{ __("Visualice pagos  realizados") }}">
                    <i class="m-menu__link-icon fas fa-money-bill-alt"></i>
                    <span class="m-menu__link-text">{{ __("Pagos") }}</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                <a href="{{ route('add.payments') }}" class="m-menu__link" title="{{ __("designe pagos a diferentes estudiantes") }}">
                    <i class="m-menu__link-icon fas fa-plus"></i>
                    <span class="m-menu__link-text">{{ __("Agregar pago") }}</span>
                </a>
            </li>
        </ul>
    </div>
</li>
