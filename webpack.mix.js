const mix=require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
//    .js('resources/js/jquery-3.7.1.min.js', 'public/js')
//    .js('resources/js/cart.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');
