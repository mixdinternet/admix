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
        swal({
            title: '{{ Session::get('caffeinated.flash.message') }}',
            type: '{{ (Session::get('caffeinated.flash.level') == 'danger') ? 'error' : Session::get('caffeinated.flash.level') }}',
            timer: 5000,
            showConfirmButton: false
        }).done();
    </script>
@endif
