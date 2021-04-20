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

mix
//.copy('resources/js/js.js', 'public/js/js.js');
//.sass('resources/sass/admin.scss', 'public/css/admin.css');
 .js('resources/js/app.js', 'public/js')
     .sass('resources/sass/app.scss', 'public/css')  
//     .sass('node_modules/bootstrap-select/sass/bootstrap-select.scss', 'public/css/bootstrap-select.css')
//     .js('node_modules/bootstrap-select/js/bootstrap-select.js', 'public/js/bootstrap-select.js');


