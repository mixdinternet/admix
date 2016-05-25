<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrativo - {!! strip_tags(config('admin.name')) !!}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="summernoteUpload" content="{{ route('admin.summernote') }}" />
    <!--css-->
    <link rel="stylesheet" type="text/css"
          href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    {{-- <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}"/> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}"/>

    @yield('header-scripts')
</head>
<body class="skin-admix m-fixed sidebar-mini">
<div class="wrapper">

    @include('admin.partials.header')

    @include('admin.partials.aside')

    <div class="content-wrapper">

        @yield('content')

    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b><a href="http://www.mixd.com.br/" target="_blank">MIXD Internet</a></b>
        </div>
        <strong>&nbsp;</strong>
    </footer>
</div>

<script src="{{ asset('assets/js/admin.js') }}"></script>

@yield('footer-scripts')

@include('flash::message')

</body>
</html>