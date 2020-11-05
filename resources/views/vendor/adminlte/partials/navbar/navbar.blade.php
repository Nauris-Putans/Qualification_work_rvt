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
            @if (Session::get('locale') == 'us')
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <span class="flag-icon flag-icon-us"></span>
                </a>
            @endif

            @if (Session::get('locale') == 'lv')
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <span class="flag-icon flag-icon-lv"></span>
                </a>
            @endif

            @if (Session::get('locale') == 'ru')
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <span class="flag-icon flag-icon-ru"></span>
                </a>
            @endif

            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="locale/us" class="dropdown-item {{ Session::get('locale') == 'us' ? 'active' : '' }}">
                    <i class="flag-icon flag-icon-us mr-2"></i> English
                </a>
                <a href="locale/lv" class="dropdown-item {{ Session::get('locale') == 'lv' ? 'active' : '' }}">
                    <i class="flag-icon flag-icon-lv mr-2"></i> Latvian
                </a>
                <a href="locale/ru" class="dropdown-item {{ Session::get('locale') == 'ru' ? 'active' : '' }}">
                    <i class="flag-icon flag-icon-ru mr-2"></i> Russian
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
