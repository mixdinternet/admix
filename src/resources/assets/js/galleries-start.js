$(function () {

    $('.jq-image-zoom').on('click', function (e) {
        e.preventDefault();

        bootbox.dialog({
            title: 'Formato original',
            message: '<p><img src="' + $(this).attr('href') + '" class="img-responsive" /></p> ' + $(this).attr('title')
        });
    });

    $('.jq-image-edit').on('click', function (e) {
        e.preventDefault();

        var that = $(this);

        var id = $(this).attr('data-id');
        var image = $(this).attr('data-image');
        var description = $(this).attr('data-description');
        var url = $(this).attr('data-update-url');

        var template = '' +
            '<div class="row">' +
            '<div class="col-md-12">' +
            '<div class="fake-form" id="fake_' + id + '">' +
            '<div class="form-group">' +
            '<img src="' + image + '" id="image" class="img-responsive" />' +
            '</div>' +
            '<div class="form-group">' +
            '<label for="description">Descrição</label>' +
            '<input type="text" name="description" id="description" class="form-control" value="' + description + '">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        bootbox.dialog({
            title: 'Atualizar Imagem',
            message: template,
            buttons: {
                cancel: {
                    label: "Cancelar",
                    className: "btn-default btn-flat",
                    callback: function () {

                    }
                },
                ok: {
                    label: "Salvar",
                    className: "btn-primary btn-flat",
                    callback: function () {
                        var dataDescription = $('#fake_' + id).find('#description').val();
                        var data = 'id=' + id
                            + '&description=' + dataDescription
                            + '&_token=' + $("input[name='_token']").val();
                        $.post(url, data);
                        that.attr('data-description', dataDescription);

                        return true;
                    }
                }
            }
        });
    });

    $('.jq-image-remove').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var that = $(this);

        bootbox.dialog({
            title: "Remover imagem",
            message: "Tem certeza que deseja remover este item?",
            buttons: {
                cancel: {
                    label: "Cancelar",
                    className: "btn-default btn-flat",
                    callback: function () {

                    }
                },
                ok: {
                    label: "Sim",
                    className: "btn-primary btn-flat",
                    callback: function () {
                        $.post(that.parents('.sortable').attr('data-destroy-url'), 'id=' + id + '&_token=' + $("input[name='_token']").val());
                        $('#image_' + id).fadeOut();

                        return true;
                    }
                }
            }
        });


    });

    if ($("div.dropzone").length) {
        $("div.dropzone").each(function(k){
            var that = $(this);
            var gallery = that.find('input[name="gallery[]"]').val();

            console.log(that);

            $.fn.dzParams = function () {
                var inputs = this.serializeArray();
                var params = {};
                $.each(inputs, function (i, v) {
                    params[v.name] = v.value;
                });
                return params;
            };
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#" + that.attr('id'), {
                url: that.data('url'),
                addRemoveLinks: true,
                maxFilesize: 5, // MB
                clickable: true,
                parallelUploads: 1,
                params: that.find(':input').dzParams(),
                thumbnailWidth: "200",
                thumbnailHeight: "150",

                acceptedFiles: 'image/*',
                dictDefaultMessage: 'Arraste os arquivos aqui para enviar',
                dictFallbackMessage: 'O seu navegador não aceita arrastar aquivos',
                dictFallbackText: 'Por favor, utilize o formulário abaixo para enviar os arquivos',
                dictInvalidFileType: 'Arquivo não suportado',
                dictFileTooBig: "O arquivo é muito grande ({{filesize}}Mb). O máximo permitido é {{maxFilesize}}Mb.",
                dictResponseError: 'Erro ao enviar o arquivo! ({{statusCode}})',
                dictCancelUpload: 'Cancelar',
                dictCancelUploadConfirmation: 'Tem certeza que deseja cancelar o envio?',
                dictRemoveFile: 'Remover',
                dictMaxFilesExceeded: 'Limite de arquivos atingido'
            });

            myDropzone.on("complete", function (file) {
                var resp = $.parseJSON(file.xhr.response);
                that.append('<input type="hidden" name="images[' + gallery + '][]" value="' + resp.name + '" />');
            });

        });
    }

    $(".sortable").each(function(k) {
        var that = $(this);
        that.sortable({
            opacity: 0.5,
            revert: 300,
            placeholder: "col-sm-6 col-md-3 ui-sortable-placeholder",
            start: function (e, ui) {
                var placeholderHeight = ui.item.outerHeight();
                var placeholderWidth = ui.item.outerWidth();
                $('.ui-sortable-placeholder').html('<div class="box box-solid"></div>');
                $('.ui-sortable-placeholder .box').height(placeholderHeight - 40);
            },
            update: function (event, ui) {
                var itemOrder = that.sortable('serialize') + '&_token=' + $("input[name='_token']").val();
                $.post($('.sortable').attr('data-url'), itemOrder);
            }
        });
        that.disableSelection();
    });
});