<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Administrativo - {!! config('app.name') !!}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!--css-->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}"/>

    <style>
        .form-horizontal .form-group {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        {!! config('admin.name') !!}
    </div>
    <div class="login-box-body">

        @yield('content')

    </div>
</div>

<script src="{{ asset('assets/js/admin.js') }}"></script>

@include('flash::message')

</body>
</html>