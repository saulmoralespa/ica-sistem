<header id="m_header" class="m-grid__item m-header " m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10">
    <div class="m-header__top">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">

                <!-- begin::Brand -->
                <div class="m-stack__item m-brand m-stack__item--left">
                    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{ route('home') }}" class="m-brand__logo-wrapper">
                                {{--<img alt="" src="{{ asset('images/logo.jpg') }}" class="m-brand__logo-desktop">--}}
                                {{--<img alt="" src="assets/demo/demo10/media/img/logo/logo_mini.png" class="m-brand__logo-mobile" />--}}
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <!-- begin::Responsive Header Menu Toggler-->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- end::Responsive Header Menu Toggler-->
                            <!-- begin::Topbar Toggler-->
                            {{--<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>--}}
                            <!--end::Topbar Toggler-->
                        </div>
                    </div>
                </div>
                <!-- end::Brand -->
                <!-- begin::Topbar -->
                <div class="m-stack__item m-stack__item--right m-header-head" id="m_header_nav">
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                {{--@include('dashboard.alarm_notifications')
                                @include('dashboard.quick_actions')--}}
                                @include('dashboard.carduser')
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end::Topbar -->
            </div>
        </div>
    </div>
    <div class="m-header__bottom">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">

                <!-- begin::Horizontal Menu -->
                <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                        <i class="la la-close"></i>
                    </button>
                    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            @include(' navigations.students')
                            @include(' navigations.payments')
                            @include(' navigations.costs')
                            @include(' navigations.reports')
                            @include(' navigations.users')
                        </ul>
                    </div>
                </div>

                <!-- end::Horizontal Menu -->
            </div>
        </div>
    </div>
</header>