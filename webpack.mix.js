let mix = require('laravel-mix');
var fs = require('fs');

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
/*test test*/
mix.copy('resources/assets/js/', 'public/js/');
mix.copy('resources/assets/fonts/', 'public/fonts/');
mix.copy('resources/assets/images/', 'public/images/');
mix.copy('resources/assets/css/', 'public/css/');

/*var to_read = ('resources/assets/js/');
var srcs_files = fs.readdirSync(to_read);
var dest_path = ("public/js/");
var path_len = to_read.length;
var dest = [];
for(var n=0; n < srcs_files.length; n++){
    all = to_read.concat(srcs_files[n]);
    if(fs.isFile(all))
        console.log(all);
    dest[n] = dest_path.concat((srcs_files[n]).substr(path_len, srcs_files[n].length));
    console.log(dest[n]);
}*/

/*for(var n=0; n < srcs_files.length; n++){
    mix.js(srcs_files[n], dest[n]);
}*/

/*mix.styles([
    'resources/assets/css/magnific-popup.css', 
    'resources/assets/css/multi-step.css', ],
             'public/css/app.css' )*/
mix.scripts(
     [ 
     'resources/assets/js/sweetalert2.js',
     'resources/assets/js/magnific-popup.js',
     ],      'public/js/app.js'
    );