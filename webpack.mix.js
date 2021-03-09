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

mix.js('resources/js/app.js', 'public/js').sourceMaps();
mix.sass('resources/sass/app.scss', 'public/css');

//User side styles
mix.sass('resources/sass/userAdmin.scss', 'public/css');

//Admin side styles
mix.sass('resources/sass/admin.scss', 'public/css');

//Guests side styles
mix.sass('resources/sass/section.scss', 'public/css');