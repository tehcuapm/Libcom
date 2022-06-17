const mix = require("laravel-mix");
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js");
mix.js("resources/js/place-autocomplete.js", "public/js");
mix.js("resources/js/panierajax.js", "public/js");
mix.js("resources/js/panierview.js", "public/js");
mix.js("resources/js/message.js", "public/js");
mix.js("resources/js/dom_helper.js", "public/js");
mix.js("resources/js/adminajax.js", "public/js");
mix.js("resources/js/header.js", "public/js");
mix.js("resources/js/catalog.js", "public/js");
mix.js("resources/js/product.js", "public/js");
mix.js("resources/js/admin_users.js", "public/js");
