    <?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'WEBcheck',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => null,
    'logo_img' => 'vendor/adminlte/dist/img/Logo.png',
    'logo_img_class' => 'navbar-brand LogoPadding LogoCenter',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'navbar-brand LogoPadding LogoCenter',
    'logo_img_alt' => 'WEBcheck logo',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#71-layout
    |
    */

    'layout_topnav' => false,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#721-authentication-views-classes
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#722-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-info navbar-navy elevation-4',
    'classes_sidebar_nav' => 'nav-child-indent nav-legacy',
    'classes_topnav' => 'navbar-navy navbar-dark elevation-1',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#73-sidebar
    |
    */

    'sidebar_mini' => false,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#74-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => '/dashboard',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#92-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#8-menu-configuration
    |
    */

    'menu' => [
        //
        // User admin free
        //
        [
            'text' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'classes' => 'text-bold',
            'url' => '/dashboard',
            'role' => 'userFree',
        ],
        [
            'text' => 'Monitoring',
            'icon' => 'fas fa-chart-line',
            'classes' => 'text-bold',
            'role' => 'userFree',
            'submenu' => [
                [
                    'text' => 'Monitors',
                    'icon' => 'fas fa-desktop',
                    'submenu' => [
                        [
                            'text' => 'Monitor List',
                            'icon' => 'fas fa-history',
                            'url' => '/monitoring/monitors/list',
                            'role' => 'userFree',
                        ],
                        [
                            'text' => 'Add Monitor',
                            'icon' => 'fas fa-plus',
                            'url' => '/monitoring/monitors/add',
                            'role' => 'userFree',
                        ],
                    ]
                ],
                [
                    'text' => 'Uptime',
                    'icon' => 'fas fa-eye',
                    'url' => '/monitoring/uptime',
                    'role' => 'userFree',
                ],
                [
                    'text' => 'Page Speed',
                    'icon' => 'fas fa-stopwatch',
                    'url' => '/monitoring/page-speed',
                    'role' => 'userFree',
                ],
                [
                    'text' => 'Real User Monitoring',
                    'icon' => 'fas fa-users',
                    'url' => '/monitoring/real-user-monitoring',
                    'role' => 'userFree',
                ],
            ]
        ],
        [
            'text' => 'Alerts',
            'icon' => 'fas fa-bell',
            'classes' => 'text-bold',
            'url' => '/alerts',
            'role' => 'userFree',
        ],
        [
            'text' => 'Settings',
            'icon' => 'fas fa-cog',
            'classes' => 'text-bold',
            'url' => '/settings',
            'role' => 'userFree',
        ],
        [
            'text' => 'Support',
            'icon' => 'fas fa-question-circle',
            'classes' => 'text-bold',
            'url' => '/support',
            'role' => 'userFree',
        ],
        [
            'header' => '',
            'role' => 'userFree',
        ],
        [
            'text' => 'Back',
            'icon' => 'fas fa-arrow-left',
            'classes' => 'text-bold',
            'url' => '/',
            'role' => 'userFree',
        ],

        //
        // User Admin Pro
        //
        [
            'text' => 'Pro settings',
            'icon' => 'fas fa-cog',
            'classes' => 'text-bold',
            'url' => '/settings',
            'role' => 'userPro',
        ],
        [
            'header' => '',
            'role' => 'userPro',
        ],
        [
            'text' => 'Back',
            'icon' => 'fas fa-arrow-left',
            'classes' => 'text-bold',
            'url' => '/',
            'role' => 'userPro',
        ],

        //
        // Admin
        //
        [
            'text' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'classes' => 'text-bold',
            'url' => '/admin/dashboard',
            'role' => 'admin',
        ],
        [
            'text' => 'Users',
            'icon' => 'fas fa-users',
            'classes' => 'text-bold',
            'url' => '/admin/users',
            'role' => 'admin',
        ],
        [
            'text' => 'Team',
            'icon' => 'fas fa-users',
            'classes' => 'text-bold',
            'role' => 'admin',
            'submenu' => [
                [
                    'text' => 'Members',
                    'icon' => 'fas fa-clipboard-list',
                    'url' => '/admin/team/members',
                    'role' => 'admin',
                ],
                [
                    'text' => 'Privileges',
                    'icon' => 'fas fa-key',
                    'role' => 'admin',
                    'submenu' => [
                        [
                            'text' => 'Roles',
                            'icon' => 'fas fa-user-cog',
                            'role' => 'admin',
                            'submenu' => [
                                [
                                    'text' => 'Add Role',
                                    'icon' => 'fas fa-plus',
                                    'url' => '/admin/add-role',
                                    'role' => 'admin',
                                ],
                                [
                                    'text' => 'Assign Role',
                                    'icon' => 'fas fa-wrench',
                                    'url' => '/admin/assign-role',
                                    'role' => 'admin',
                                ],
                            ],
                        ],
                        [
                            'text' => 'Permissions',
                            'icon' => 'fas fa-user-cog',
                            'role' => 'admin',
                            'submenu' => [
                                [
                                    'text' => 'Add Permission',
                                    'icon' => 'fas fa-plus',
                                    'url' => '/admin/add-permission',
                                    'role' => 'admin',
                                ],
                                [
                                    'text' => 'Assign Permission',
                                    'icon' => 'fas fa-wrench',
                                    'url' => '/admin/assign-permission',
                                    'role' => 'admin',
                                ],
                            ],
                        ],
                    ]
                ],
            ]
        ],
        [
            'text' => 'Tickets',
            'icon' => 'fas fa-ticket-alt',
            'classes' => 'text-bold',
            'url' => '/admin/tickets',
            'role' => 'admin',
        ],
        [
            'text' => 'Settings',
            'icon' => 'fas fa-cog',
            'classes' => 'text-bold',
            'url' => '/admin/settings',
            'role' => 'admin',
        ],
        [
            'header' => '',
            'role' => 'admin',
        ],
        [
            'text' => 'Back',
            'icon' => 'fas fa-arrow-left',
            'classes' => 'text-bold',
            'url' => '/',
            'role' => 'admin',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#83-custom-menu-filters
    |
    */

    'filters' => [
//        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
        App\RoleMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#91-plugins
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#93-livewire
    */

    'livewire' => false,
];
