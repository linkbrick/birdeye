let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .scripts('resources/assets/js/vue_init.js', 'public/js/vue_init.js')
    .scripts([
        'resources/assets/js/material-dashboard/core/jquery.min.js',
        'resources/assets/js/material-dashboard/core/popper.min.js',
        'resources/assets/js/material-dashboard/bootstrap-material-design.js',
        'resources/assets/js/material-dashboard/plugins/moment.min.js',
        'resources/assets/js/material-dashboard/plugins/bootstrap-selectpicker.js',
        'resources/assets/js/material-dashboard/plugins/bootstrap-tagsinput.js',
        'resources/assets/js/material-dashboard/plugins/jasny-bootstrap.min.js',
        'resources/assets/js/material-dashboard/plugins/jquery.flexisel.js',
        'resources/assets/js/material-dashboard/plugins/bootstrap-datetimepicker.min.js',
        'resources/assets/js/material-dashboard/plugins/nouislider.min.js',
        'resources/assets/js/material-dashboard/material-dashboard.js?v=2.0.1',
        'resources/assets/js/material-dashboard/jquery.select-bootstrap.js',
        'resources/assets/js/material-dashboard/sweetalert2.js',
    ], 'public/js/material.js')
    .scripts(['resources/assets/js/material-dashboard/plugins/sweetalert2.js'], 'public/js/sweetalert.js')
   .sass('resources/assets/sass/material-dashboard/material-dashboard.scss', 'public/css');

