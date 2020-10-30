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
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'node_modules/vue-plyr/dist/vue-plyr.css'
    ], 'public/css/app.css')
    .js([
        'resources/js/app.js',
    ],  'public/js/app.js').sourceMaps();

// mix.js('resources/js/app.js', 'public/js');
