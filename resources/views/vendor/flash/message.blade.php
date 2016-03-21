@if (Session::has('caffeinated.flash.message'))

    {{-- overkill --}}
    {{ header('Cache-Control: no-store, private, no-cache, must-revalidate') }}
    {{ header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false) }}
    {{ header('Pragma: public') }}
    {{ header('Expires: Sat, 26 Jul 1997 05:00:00 GMT') }}
    {{ header('Expires: 0', false) }}
    {{ header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT') }}
    {{ header('Pragma: no-cache') }}

    <script>
        $.notify({
            message: '{{ Session::get('caffeinated.flash.message') }}'
        }, {
            type: '{{ Session::get('caffeinated.flash.level') }}',
            mouse_over: 'pause',
            timer: '800',
            animate: {
                enter: 'animated bounceInRight',
                exit: 'animated bounceOutRight'
            },
            z_index: 1050
        });
    </script>
@endif
