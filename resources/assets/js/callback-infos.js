$(function () {
    $.get("/info", function (data) {
        if (data.csrf_token) {
            $("input[name='_token']").val(data.csrf_token)
        }

        if (data.flash) {
            $.notify({
                    message: data.flash.message
                },
                {
                    type: data.flash.level,
                    mouse_over: 'pause',
                    timer: '800',
                    animate: {
                        enter: 'animated bounceInRight',
                        exit: 'animated bounceOutRight'
                    }
                    ,
                    z_index: 1050
                }
            );
        }
    });
});