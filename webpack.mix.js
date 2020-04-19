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
const webpack = require('webpack');

mix
    .js('resources/js/admin/basic.js', 'public/adm/js')
    .js('resources/js/admin/dashboard.js', 'public/adm/js')
    .js('resources/js/admin/order-edit.js', 'public/adm/js')
    .js('resources/js/admin/product.js', 'public/adm/js')

    // .js('resources/js/admin/app.js', 'public/adm/js')
    .js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/admin/app.scss', 'public/adm/css')
    .webpackConfig({
        plugins: [
            new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
        ]
    })
;
