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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css')
    .sourceMaps();

// mix.styles('node_modules/bootstrap/dist/css/bootstrap.min.css','public/css/theme.css');
   mix.styles('resources/css/Flatly.css','public/css/theme.css');
//    mix.styles('resources/css/Solar.css','public/css/theme.css');
//    mix.styles('resources/css/Darkly.css','public/css/theme.css');
    // mix.styles('resources/css/Morph.css','public/css/theme.css');


