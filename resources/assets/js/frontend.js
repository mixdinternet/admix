moment.locale("pt-br");

$.extend($.validator.messages, {
    required: "Este campo &eacute; obrigatório."
});

$(window).load(function () {

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

    /* ------------- INICIANDO SLIDER HOME -------------- */
    $('.slider-home-full-banner').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        autoplay: false,
        fade: true,
        autoplaySpeed: 3000,
        speed: 1000,
        touchThreshold: 15,
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    /* Controllers */
    $('header.home .slider-controllers .btn-prev').on('click', function () {
        $('header.home .slider-home-full-banner').slick('slickPrev'); // Passando para o index anterior.
    });

    $('header.home .slider-controllers .btn-next').on('click', function () {
        $('header.home .slider-home-full-banner').slick('slickNext'); // Passando para o index seguinte.
    });

    $('header.home .slider-controllers .btn-position').on('click', function () {
        var position = ($(this).data('position') - 1); // Pega a posição atual e subtrai 1, pois o index começa com 0 (0, 1, 2, etc..).
        $('header.home .slider-home-full-banner').slick('slickGoTo', position); // Navega o slider até o index selecionado.
    });

    // Ouvinte para observar se o slider mudou o index atual, caso sim.. Ajusta o active no botão do controller
    $('header.home .slider-home-full-banner').on('afterChange', function () {
        var index = $('header.home .slider-home-full-banner .index.slick-active').data('slick-index') + 1; // Pegando o valor do index e somando com + 1, pois o slider inicia com index 0 e o controler com index 1.
        $('header.home .slider-controllers .btn-position').removeClass('active'); // Remove a class active de todos os index do controller.
        $('header.home .slider-controllers .btn-position[data-position=' + index + ']').addClass('active'); // Adiciona a class active no index do controller.
    });
    /* -- // -- */
    /* ------------- INICIANDO SLIDER HOME -------------- */


    /* ------------- INICIANDO SELECT -------------- */
    $('.selectpicker').selectpicker();
    /* ------------- INICIANDO SELECT -------------- */


});