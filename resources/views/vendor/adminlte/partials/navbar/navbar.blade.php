<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        <!-- Language Dropdown Menu -->
        <li class="nav-item dropdown Language">
                @if (App::getLocale() == 'en')
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="flag-icon flag-icon-us"></span>
                    </a>

                @elseif (App::getLocale() == 'lv')
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="flag-icon flag-icon-lv"></span>
                    </a>

                @elseif (App::getLocale() == 'ru')
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="flag-icon flag-icon-ru"></span>
                    </a>

                @else
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="flag-icon flag-icon-us"></span>
                    </a>
                @endif

                {{-- Languages --}}
                <div class="dropdown-menu dropdown-menu-right p-0">
                    @if (App::getLocale() == '')
                        <a href="en" class="dropdown-item {{ App::getLocale() == '' ? 'active' : '' }}">
                            <i class="flag-icon flag-icon-us mr-2"></i> @lang('English')
                        </a>

                    @else
                        <a href="en" class="dropdown-item {{ App::getLocale() == 'en' ? 'active' : '' }}">
                            <i class="flag-icon flag-icon-us mr-2"></i> @lang('English')
                        </a>
                    @endif

                    <a href="lv" class="dropdown-item {{ App::getLocale() == 'lv' ? 'active' : '' }}">
                        <i class="flag-icon flag-icon-lv mr-2"></i> @lang('Latvian')
                    </a>

                    <a href="ru" class="dropdown-item {{ App::getLocale() == 'ru' ? 'active' : '' }}">
                        <i class="flag-icon flag-icon-ru mr-2"></i> @lang('Russian')
                    </a>
                </div>
        </li>

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
