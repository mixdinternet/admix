$(function () {
    $.get("/info", function (data) {
        if (data.csrf_token) {
            $("input[name='_token']").val(data.csrf_token)
        }

        if (data.flash) {
            swal({
                title: data.flash.message,
                type: data.flash.level,
                timer: 5000,
                showConfirmButton: false
            }).done();
        }
    });
});