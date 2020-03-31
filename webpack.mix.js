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
mix.styles([
	'resources/assets/css/noty.min.css',
	'resources/assets/css/bootstrap.min.css',
	'resources/assets/sass/app.scss'
], 'public/css/all.css');

mix.scripts([
	'resources/assets/js/jquery.min.js',
	'resources/assets/js/bootstrap.min.js',
	'resources/assets/js/noty.min.js',
], 'public/js/all.js');