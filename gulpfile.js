process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

require('laravel-elixir-imagemin');
require('laravel-elixir-clear');

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

elixir.config.sourcemaps = false;
elixir.config.images = {
    folder: 'img',
    outputFolder: 'assets/img'
};

elixir(function(mix) {
    mix

        /*
         * limpeza dos arquivos antigos
         */
        .clear([
            'public/assets/css',
            'public/assets/fonts',
            'public/assets/img',
            'public/assets/js'
        ])

        /* ---------------------------------------- */

        /*
         * frontend
         **/
        .sass([
            'includes.scss'
        ], 'resources/assets/css/frontend.css')


        .styles([
            'node_modules/slick-carousel/slick/slick.css',
            'node_modules/bootstrap/dist/css/bootstrap.min.css',
            'node_modules/ui-select/dist/select.min.css',
            'resources/assets/css/frontend.css'
        ],
        'public/assets/css/frontend.css',
        './')


        .scripts([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/slick-carousel/slick/slick.min.js',
            'resources/assets/js/frontend.js',


            'node_modules/angular/angular.min.js',
            'node_modules/angular-animate/angular-animate.min.js',
            'node_modules/angular-foundation-6/dist/angular-foundation.min.js',
            'node_modules/angular-utils-pagination/dirPagination.js',
            'node_modules/angular-slick-carousel/dist/angular-slick.min.js',
            'node_modules/ui-select/dist/select.min.js',
            'node_modules/angular-sanitize/angular-sanitize.min.js',
            'node_modules/angular-route/angular-route.min.js',
            'node_modules/angular-input-masks/releases/angular-input-masks-standalone.min.js',


            'resources/assets/angular/modules/.',
            'resources/assets/angular/config/.',
            'resources/assets/angular/factory/.',
            'resources/assets/angular/services/.',
            'resources/assets/angular/controllers/.',
            'resources/assets/angular/directives/.'
        ],
        'public/assets/js/frontend.js',
        './')
        /* ---------------------------------------- */

        /*
         * administrativo
         **/

        .less([
            'admin/adminlte.less',
        ], 'resources/assets/css/adminlte.css')

        .less([
            'admin/fix.less',
        ], 'resources/assets/css/admin-fix.css')

        .styles([
            'node_modules/admin-lte/bootstrap/css/bootstrap.min.css',
            'node_modules/admin-lte/plugins/select2/select2.min.css',
            'node_modules/summernote/dist/summernote.css',
            'resources/assets/css/adminlte.css',
            'node_modules/font-awesome/css/font-awesome.min.css',
            'node_modules/ionicons/css/ionicons.min.css',
            'node_modules/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
            'node_modules/animate.css/animate.min.css',
            'node_modules/bootstrap-fileinput/css/fileinput.min.css',
            'node_modules/jquery-jcrop/css/jquery.Jcrop.min.css',
            'node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
            'resources/assets/css/admin-fix.css'
        ],
        'public/assets/css/admin.css',
        './')

        .scripts([
            'node_modules/blueimp-load-image/js/load-image.all.min.js',
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/moment/min/moment.min.js',
            'node_modules/moment/locale/pt-br.js',
            'node_modules/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js',
            'node_modules/bootstrap-fileinput/js/fileinput.min.js',
            'node_modules/bootstrap-fileinput/js/locales/pt-BR.js',
            'node_modules/bootstrap/dist/js/bootstrap.min.js',
            'node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            'node_modules/jquery-validation/dist/jquery.validate.js',
            'node_modules/jquery-validation/dist/additional-methods.js',
            'node_modules/jquery-validation/dist/localization/messages_pt_BR.js',
            'node_modules/jquery.maskedinput/src/jquery.maskedinput.js',
            'node_modules/jquery-maskmoney/dist/jquery.maskMoney.min.js',
            'node_modules/bootbox/bootbox.min.js',
            'node_modules/bootstrap-notify/bootstrap-notify.min.js',
            'node_modules/jquery-jcrop/js/jquery.Jcrop.min.js',
            'node_modules/summernote/dist/summernote.min.js',
            'node_modules/summernote/dist/lang/summernote-pt-BR.min.js',
            'node_modules/admin-lte/plugins/select2/select2.full.min.js',
            'node_modules/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js',
            'node_modules/admin-lte/plugins/fastclick/fastclick.js',
            'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.js',
            'node_modules/admin-lte/plugins/chartjs/Chart.min.js',
            'node_modules/admin-lte/dist/js/app.min.js',

            'resources/assets/js/jquery.chain.js',
            'resources/assets/js/admin.js',
        ],
        'public/assets/js/admin.js',
        './')

        .copy([
            'node_modules/font-awesome/fonts',
            'node_modules/ionicons/fonts',
            'node_modules/bootstrap/fonts'
        ], 'public/assets/fonts')

        .copy([
            'node_modules/bootstrap-fileinput/img',
            'node_modules/jquery-jcrop/css/Jcrop.gif'
        ], 'public/assets/img')

        /* comprimi resources/assets/img para public/assets/img */
        .imagemin({
            optimizationLevel: 3,
            progressive: true,
            interlaced: false,
            svgoPlugins: [{
                removeViewBox: false
            }]
        })
});
