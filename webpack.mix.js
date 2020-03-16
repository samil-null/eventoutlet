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

mix.sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/app/app.js', 'public/js/');
mix.js('resources/js/pages/home.js', 'public/js/pages');
mix.js('resources/js/pages/offers.js', 'public/js/pages');
mix.js('resources/js/pages/users.js', 'public/js/pages');
mix.js('resources/js/common/algo.js', 'public/js/common');


mix.js('resources/js/admin/index.js', 'public/js/admin')
    .sass('resources/sass/admin/index.scss', 'public/css/admin');

mix.js('resources/js/api/video/index.js', 'public/js/api/video');
