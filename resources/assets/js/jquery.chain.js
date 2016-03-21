$(function () {

    /* TODO Melhorar consulta e melhorar o plugin */

    $('select.jq-select2').width('100%').select2();

    $('[data-load]').each(function () {
        var select = $(this);
        var load = select.attr('data-load');
        var loadPlaceholder = select.attr('data-load-placeholder') || '-';
        var selected = select.attr('data-selected');

        select.select2({
            data: [
                {id: '', text: 'Carregando...'}
            ]
        }).attr('disabled', 'disabled');

        var option = [];
        option.push({id: "", text: loadPlaceholder});
        $.get(load)
            .done(function (response) {
                $.each(response, function (key, val) {
                    option.push({id: val, text: key, selected: (val == selected)});
                });
                select
                    .empty()
                    .select2({
                        data: option
                    })
                    /*.append('<option value="">' + loadPlaceholder + '</option>')*/
                    .removeAttr('disabled')
                    .find('option:first').attr('value', '');
            })
            .error(function(){
                select
                    .empty()
                    .select2({
                        data: option
                    })
                    .append('<option value="">' + loadPlaceholder + '</option>')
                    .removeAttr('disabled')
                    .find('option:first').attr('value', '');
            });
    });

    $('[data-target]').each(function(){
        var select = $(this);
        var targetSelect = $(select.attr('data-target'));
        var targetLoad = select.attr('data-target-load');
        var targetLoadPlaceholder = select.attr('data-target-load-placeholder') || '-';
        var targetSelected = $(targetSelect).attr('data-selected') || '';
        select.on('change', function(){

            targetSelect
                .empty()
                .select2({
                    data: [
                        {id: '', text: 'Carregando...'}
                    ]
            }).attr('disabled', 'disabled');

            var option = [];
            option.push({id: '', text: targetLoadPlaceholder});
            $.get(targetLoad + '/' + $(this).val())
                .done(function (response) {
                    $.each(response, function (key, val) {
                        option.push({id: val, text: key, selected: (val == targetSelected)});
                    });
                    targetSelect
                        .empty()
                        .append('<option value="">' + targetLoadPlaceholder + '</option>')
                        .select2({
                            data: option
                        }).removeAttr('disabled')
                        .find('option:first').attr('value', '')
                        .trigger('change');
                })
                .error(function(){
                    targetSelect
                        .empty()
                        .append('<option value="">' + targetLoadPlaceholder + '</option>')
                        .select2({
                            data: [{id: '', text: '-'}]
                        })
                        .removeAttr('disabled')
                        .find('option:first').attr('value', '');
                });
        });
    });

});