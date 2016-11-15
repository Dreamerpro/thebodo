const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
	// mix.styles('components/font-awesome/font-awesome.css','public/css/libraries.css');
    mix.sass('app.scss')
       .webpack('app.js');
    mix.styles(['node_modules/animate.css/animate.css','public/css/app.css'],'public/css/app.css', './');
});
