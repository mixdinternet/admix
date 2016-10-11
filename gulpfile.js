process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix

        /*
         * limpeza dos arquivos antigos
         */
        .clear([
            'src/public/assets/css',
            'src/public/assets/fonts',
            'src/public/assets/img',
            'src/public/assets/js'
        ])

        .less([
            'src/resources/assets/less/admin/adminlte.less',
        ], 'src/resources/assets/css/adminlte.css',
        './')

        .less([
            'src/resources/assets/less/admin/fix.less',
        ], 'src/resources/assets/css/admin-fix.css',
        './')

        .styles([
                'node_modules/admin-lte/bootstrap/css/bootstrap.min.css',
                'node_modules/admin-lte/plugins/select2/select2.min.css',
                'node_modules/summernote/dist/summernote.css',
                'src/resources/assets/css/adminlte.css',
                'node_modules/font-awesome/css/font-awesome.min.css',
                'node_modules/ionicons/css/ionicons.min.css',
                'node_modules/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
                'node_modules/animate.css/animate.min.css',
                'node_modules/bootstrap-fileinput/css/fileinput.min.css',
                'node_modules/jquery-jcrop/css/jquery.Jcrop.min.css',
                'node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
                'node_modules/sweetalert2/dist/sweetalert2.min.css',
                'src/resources/assets/css/admin-fix.css',
                'src/resources/assets/css/dropzonejs.css',
            ],
            'src/public/assets/css/admin.css',
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
                'node_modules/sweetalert2/dist/sweetalert2.min.js',
                'node_modules/jquery-jcrop/js/jquery.Jcrop.min.js',
                'node_modules/summernote/dist/summernote.min.js',
                'node_modules/summernote/dist/lang/summernote-pt-BR.min.js',
                'node_modules/admin-lte/plugins/select2/select2.full.min.js',
                'node_modules/admin-lte/plugins/select2/i18n/pt-BR.js',
                'node_modules/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js',
                'node_modules/admin-lte/plugins/fastclick/fastclick.js',
                'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.js',
                'node_modules/admin-lte/plugins/chartjs/Chart.min.js',
                'node_modules/admin-lte/dist/js/app.min.js',
                'src/resources/assets/js/dropzone.min.js',
                'src/resources/assets/js/jquery-ui.sortable.min.js',
                'src/resources/assets/js/galleries-start.js',
                'src/resources/assets/js/jquery.chain.js',
                'src/resources/assets/js/admin.js',
            ],
            'src/public/assets/js/admin.js',
            './')

        .copy([
            'node_modules/font-awesome/fonts',
            'node_modules/ionicons/fonts',
            'node_modules/bootstrap/fonts'
        ], 'src/public/assets/fonts')

        .copy([
            'src/resources/assets/img',
            'node_modules/bootstrap-fileinput/img',
            'node_modules/jquery-jcrop/css/Jcrop.gif'
        ], 'src/public/assets/img')
});