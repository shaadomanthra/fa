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
    .sass('resources/sass/app.scss', 'public/css');

mix.styles(['public/css/app.css',
    'public/css/style_page.css','public/css/sp2.css'
], 'public/css/style_page.min.css');

mix.styles(['public/css/app.css','public/css/test.css',
    'public/css/general.css'
], 'public/css/styles.css');

mix.styles(['public/css/app.css','public/css/test.css',
    'public/css/piofx.css'
], 'public/css/styles_piofx.css');

mix.js(['public/js/app.js',
    'public/js/global.js'
], 'public/js/script.js');

mix.js(['public/js/jquery.js','public/js/waypoint.js','public/js/jquery.counterup.min.js',
], 'public/js/script2.js');

