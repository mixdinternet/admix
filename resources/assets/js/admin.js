//var locale = window.navigator.userLanguage || window.navigator.language;
//moment.locale(locale);
moment.locale("pt-br");

$.extend($.validator.messages, {
    required: "Este campo &eacute; obrigatório."
});

//$(window).load(function(){
$(function () {

    $('[data-toggle="popover"]').popover();

    if ($.mask) {
        $('.mask-phone').focusout(function () {
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }).trigger('focusout');


        //http://alexjunioralves.blogspot.com.br/2013/08/mascara-cpfcnpj-para-o-mesmo-campo.html
        $('.mask-cpfcnpj').on('keyup', function () {
            var cpfcnpj, element;
            element = $(this);
            cpfcnpj = element.val().replace(/\D/g, '');
            if ((cpfcnpj.length === 11) || (cpfcnpj.length === 0)) {
                element.mask("999.999.999-99?99999");
            }

            if (cpfcnpj.length >= 14) {
                element.mask("99.999.999/9999-99");
            }
        }).trigger('keyup');

        $(".mask-date").mask("99/99/9999");
        $(".mask-zipcode").mask("99999-999");
        $(".mask-cpf").mask("999.999.999-99");
        $(".mask-cnpj").mask("99.999.999/9999-99");
        $(".mask-hour").mask("99:99");
    }

    $(".mask-money").maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        decimal: ',',
        thousands: '.',
        affixesStay: false
    });

    $(".mask-size").maskMoney({
        prefix: '',
        decimal: '',
        thousands: '.',
        affixesStay: false,
        precision: 0
    });

    $(".mask-integer").maskMoney({
        prefix: '',
        decimal: '',
        thousands: '',
        affixesStay: false,
        precision: 0
    });

    $(".mask-float").maskMoney({
        prefix: '',
        decimal: ',',
        thousands: '',
        affixesStay: false,
        precision: 2
    });

    $('#zipcode').on('blur', function () {
        var $this = $(this);
        var cep = $this.val().replace('-', '');
        if (cep.length === 8) {
            $.getJSON("http://cep.mixd.com.br/php/getCep.php", {cep: cep, formato: "json"},
                function (result) {
                    if (result.resultado != 1) {
                        console.log(result.message || "Houve um erro desconhecido");
                        return;
                    }
                    $('#neighborhood').val(result.bairro);
                    $('#address').val(result.tipo_logradouro + ' ' + result.logradouro);

                    // se for input
                    if ($('#state').is('input')) {
                        $('#state').val(result.uf_nome);
                    }

                    if ($('#city').is('input')) {
                        $('#city').val(result.cidade);
                    }
                }
            );
        }
    });

    $('.jq-form-validate').each(function () {
        var id = $(this).attr('id');
        $("#" + id).validate({
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                if (element.type === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass).parent().addClass('has-error').removeClass('has-success');
                } else {
                    $(element).addClass(errorClass).removeClass(validClass).parent().parent().addClass('has-error').removeClass('has-success');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if (element.type === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass).parent().addClass('has-success').removeClass('has-error').find('span.help-block').hide();
                } else {
                    $(element).removeClass(errorClass).addClass(validClass).parent().parent().addClass('has-success').removeClass('has-error').find('span.help-block').hide();
                }
            }
        });
    });

    $('.jq-datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
        , locale: moment.locale('pt-br')
    });

    $('.jq-datepicker').datetimepicker({
        format: 'DD/MM/YYYY'
        , locale: moment.locale('pt-br')
    });

    $('.jq-select2').width('100%').select2();

    var previewCacheFile;
    var previewhasError = false;
    $(".filestyle").fileinput({
        showUpload: false,
        language: "pt-BR",
        minImageWidth: 640,
        minImageHeight: 480,
        browseIcon: '<i class="fa fa-folder-open"></i>',
        removeIcon: '<i class="fa fa-times"></i>',
        removeClass: 'btn btn-danger btn-flat',
        indicatorNew: '<i class="fa fa-thumbs-o-down text-warning"></i>',
        indicatorSuccess: '<i class="fa fa-check file-icon-large text-success"></i>',
        indicatorError: '<i class="fa fa-exclamation text-danger"></i>',
        indicatorLoading: '<i class="fa fa-thumbs-o-up text-muted"></i>',
        layoutTemplates: {
            main1: '{preview}\n' +
            '<div class="kv-upload-progress hide"></div>\n' +
            '<div class="input-group {class}">\n' +
            '   {caption}\n' +
            '   <div class="input-group-btn">\n' +
            '       {browse}\n' +
            '       {remove}\n' +
            '   </div>\n' +
            '</div>',
            icon: ''
        },
    }).on('fileloaded', function (event, file, previewId, index, reader) {
        // que lindo isso cara
        previewCacheFile = file;
    }).on('fileimageloaded', function (event, previewId) {

        if(previewhasError == true) {
            $('#' + event.target.id).attr('disabled', 'disabled');
            return false;
        }

        var _this = event.currentTarget;
        var input = $(_this).attr('id');
        //console.log($(_this).parents('form'));
        $(_this).parents('form').find("input[name='remove[]'][value='" + input + "']").remove();

        bootbox.dialog({
            title: 'Ajustar imagem',
            message: '<img src="" id="jcrop_target_' + previewId + '" class="img-responsive" />',
            closeButton: false,
            buttons: {
                success: {
                    label: "Salvar",
                    className: "btn-flat btn-primary",
                    callback: function () {
                        console.log('Sucesso!');
                        crop();
                    }
                }
            }
        });
        var target = $('#jcrop_target_' + previewId);

        var reader = new window.FileReader();
        //reader.readAsDataURL(file);
        reader.readAsDataURL(previewCacheFile);
        reader.onloadend = function () {

            $('#crop-' + input + '-w').remove();
            $('#crop-' + input + '-h').remove();
            $('#crop-' + input + '-x').remove();
            $('#crop-' + input + '-y').remove();

            $(_this).parents('form').append('<input type="hidden" id="crop-' + input + '-w" name="crop[' + input + '][w]" value="640">');
            $(_this).parents('form').append('<input type="hidden" id="crop-' + input + '-h" name="crop[' + input + '][h]" value="480">');
            $(_this).parents('form').append('<input type="hidden" id="crop-' + input + '-x" name="crop[' + input + '][x]" value="0">');
            $(_this).parents('form').append('<input type="hidden" id="crop-' + input + '-y" name="crop[' + input + '][y]" value="0">');


            base64data = reader.result;
            $('#jcrop_target_' + previewId).attr('src', base64data).Jcrop({
                boxWidth: 570,
                boxHeight: 570,
                bgOpacity: .4,
                aspectRatio: $(_this).attr('data-aspect-ratio') || 4 / 3,
                keySupport: false,
                onChange: updateCoords,
                onSelect: updateCoords,
                setSelect: [0, target.prop("naturalWidth"), target.prop("naturalHeight"), 0],
                onRelease : releaseCheck
            });
        }

        function releaseCheck() {
            this.setOptions({
                setSelect: [0, target.prop("naturalWidth"), target.prop("naturalHeight"), 0]
            });
        }

        function updateCoords(c) {

            var w = (Math.round(c.w) < 0) ? 0 : Math.round(c.w);
            var h = (Math.round(c.h) < 0) ? 0 : Math.round(c.h);
            var x = (Math.round(c.x) < 0) ? 0 : Math.round(c.x);
            var y = (Math.round(c.y) < 0) ? 0 : Math.round(c.y);

            $('#crop-' + input + '-w').val(w);
            $('#crop-' + input + '-h').val(h);
            $('#crop-' + input + '-x').val(x);
            $('#crop-' + input + '-y').val(y);
        }

        function crop() {
            /*
             * TODO: Calcular corretamente o recorte do thumb
             * */
            var preview = $('#jcrop_target_' + previewId);

            var fmt = '<div style="width: 205px; height: 6px; position: absolute; display: block; background: white; margin-top: -6px;"></div>';
            var fml = '<div style="width: 6px; height: 160px; position: absolute; display: block; background: white; margin-left: -6px;"></div>';
            var fmb = '<div style="width: 205px; height: 6px; position: absolute; display: block; background: white; margin-top: 160px;"></div>';
            var fmr = '<div style="width: 6px; height: 160px; position: absolute; display: block; background: white; margin-left: 199px;"></div>';

            $('#' + previewId).attr('style', "width: 213px; height: 174px; overflow: hidden; display: block")
                .prepend(fmt)
                .prepend(fml)
                .prepend(fmb)
                .prepend(fmr);

            var thumb = $('#' + previewId + ' img');
            var thumbWidth = thumb.width();
            var thumbHeight = thumb.height();
            var mleft = Math.round(((thumb.width() * preview.attr('data-x')) / preview.prop("naturalWidth")));

            thumb.css('marginLeft', (mleft * -1));

        }
    }).on('filecleared', function (event) {
        var _this = event.currentTarget;
        var input = $(_this).attr('id');
        previewhasError = false;
        $(_this).attr('disabled', false);
        $(_this).parents('form').append('<input type="hidden" name="remove[]" value="' + input + '">');
    }).on('fileuploaderror', function(event, data, msg) {
        previewhasError = true;
    });

    //$('.jcrop_target').Jcrop();

    $('.jq-table-rocket thead input:checkbox').on('click', function () {
        $(this).parents('table').find('tbody').find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
        $.checkDestroy($('.jq-table-rocket'));
    });

    $('.jq-table-rocket tbody input:checkbox').on('change', function () {
        $.checkDestroy($('.jq-table-rocket'));
    });

    $.checkDestroy = function (wrapper) {
        if (wrapper.find('tbody input:checkbox:checked').length > 0) {
            $('.jq-actions').fadeOut('fast', function () {
                $('.jq-actions-sel').fadeIn('fast');
            });
        }
        else {
            wrapper.find('thead input:checkbox').prop('checked', false);
            $('.jq-actions-sel').fadeOut('fast', function () {
                $('.jq-actions').fadeIn('fast');
            });
        }
    };

    $('.jq-btn-save').on('click', function (e) {
        e.preventDefault();
        $('.jq-form-save').submit();
    });

    $('.jq-destroy').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);
        $.destroyMsg = '';
        $this.parents('tr').find('td').not(':first, :last').each(function () {
            $.destroyMsg += $(this).html() + ' - ';
        });
        $.destroyMsg = $.destroyMsg.substr(0, ($.destroyMsg.length - 3));

        bootbox.dialog({
            title: "Remover o item ",
            message: $.destroyMsg,
            buttons: {
                cancel: {
                    label: "Cancelar",
                    className: "btn-default btn-flat",
                    callback: function () {
                        console.log("Callback de cancelar");
                    }
                },
                ok: {
                    label: "Sim",
                    className: "btn-primary btn-flat",
                    callback: function () {
                        console.log("Callback de ok");
                        console.log($this);
                        $this.parents('form').submit();
                        return false;
                    }
                }
            }
        });
    });

    $('.jq-destroy-all').on('click', function (e) {
        e.preventDefault();
        bootbox.dialog({
            title: "Remover itens ",
            message: "Deseja remover todos os itens selecionados?",
            buttons: {
                cancel: {
                    label: "Cancelar",
                    className: "btn-default btn-flat",
                    callback: function () {
                        console.log("Callback de cancelar");
                    }
                },
                ok: {
                    label: "Sim",
                    className: "btn-primary btn-flat",
                    callback: function () {
                        console.log("Callback de ok");
                        var itens = $('.jq-table-rocket').find('input[name="id[]"]:checked');
                        var total = itens.length;
                        var ids = [];
                        var formDestroy = $('.jq-form-bulk-destroy');
                        itens.each(function (i, v) {
                            formDestroy.append('<input type="hidden" name="id[]" value="' + $(v).val() + '" />');
                            //ids[i] = $(v).val();
                        });
                        formDestroy.submit();
                    }
                }
            }
        });
    });

    var lineChartOptions = {
        showScale: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve: true,
        bezierCurveTension: 0.3,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        maintainAspectRatio: false,
        responsive: true,
        multiTooltipTemplate: "<%if (datasetLabel){%><%=datasetLabel%>: <%}%><%= value %>",
    };

    $('.jq-line-chart').each(function(){
        var ctx = $("#" + $(this).attr('id')).get(0).getContext("2d");
        new Chart(ctx).Line(eval($(this).attr('id') + 'Data'), lineChartOptions);
    });

    $(".jq-summernote").summernote({
        toolbar: [
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        lang: "pt-BR",
        callbacks: {
            onImageUpload: function(files) {
                var file = files[0];
                var that = $(this);
                var data = new FormData();
                data.append("file", file);
                data.append("_token", $('meta[name=csrf_token]').attr('content'));
                $.ajax({
                    data: data,
                    type: "POST",
                    url: that.data('upload') || $('meta[name=summernoteUpload]').attr('content'),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        var image = $('<img>').attr('src', url);
                        that.summernote("insertNode", image[0]);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

            }
        }
    });

});