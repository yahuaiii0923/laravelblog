// webpack.mix.js
const mix = require('laravel-mix');

// 配置前端资源编译
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss')
    ])
    .version();
