const mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
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
    .postCss('resources/css/main.css', 'public/css', [
        tailwindcss('./tailwind.js'),
    ]);

mix.browserSync({
    proxy: 'http://localhost:8000',
    open: false
});