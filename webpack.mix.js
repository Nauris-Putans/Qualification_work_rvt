const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
// mix.minify('public/css/addMonitor.css');//To min  css

//Basic styles, scripts
mix.js('resources/js/app.js', 'public/js').sourceMaps();
mix.sass('resources/sass/app.scss', 'public/css');

//USER SIDE
mix
    //monitor add style
    .sass('resources/sass/adminlte/user_admin/monitorAdd.scss', 'public/css/adminlte/user_admin')
    //monitor list style
    .sass('resources/sass/adminlte/user_admin/monitorList.scss', 'public/css/adminlte/user_admin')
    //uptime page style
    .sass('resources/sass/adminlte/user_admin/uptime.scss', 'public/css/adminlte/user_admin')
    //Download and Response speed pages style
    .sass('resources/sass/adminlte/user_admin/statistic.scss', 'public/css/adminlte/user_admin')
    //dashboard page style
    .sass('resources/sass/adminlte/user_admin/dashboard.scss', 'public/css/adminlte/user_admin')
    //user group
    .sass('resources/sass/adminlte/user_admin/userGroup.scss', 'public/css/adminlte/user_admin')
    //user group
    .sass('resources/sass/adminlte/user_admin/userGroupControl.scss', 'public/css/adminlte/user_admin');


//ADMIN SIDE STYLES
//Not yet created

//Guests side styles
mix
    //Footer style
    .sass('resources/sass/sections/footer.scss', 'public/css/sections')
    //Header style
    .sass('resources/sass/sections/header.scss', 'public/css/sections')
    //Home page style
    .sass('resources/sass/sections/home.blade.scss', 'public/css/sections')
    //Pricing page style
    .sass('resources/sass/sections/pricing.scss', 'public/css/sections')
    //Features page style
    .sass('resources/sass/sections/features.blade.scss', 'public/css/sections')
    //FAQ page style
    .sass('resources/sass/sections/faq.blade.scss', 'public/css/sections')
    //Contacts page style
    .sass('resources/sass/sections/contacts.blade.scss', 'public/css/sections')
    //Login, register pages style
    .sass('resources/sass/sections/login.blade.scss', 'public/css/sections');
