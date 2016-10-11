@extends('mixdinternet/admix::auth.master')

@section('content')
    {!! BootForm::open(['id' => 'recoverForm', 'class' => 'jq-form-validate', 'route' => 'admin.recover']) !!}

    <p class="login-box-msg">Recuperar senha.</p>

    @if (session()->has('status'))
        <p class="text-red">{{ session('status') }}</p>
    @endif

    {!! BootForm::email('email', null, null, ['data-rule-required' => 'true']) !!}

    <div class="row">
        <div class="col-xs-4">
        </div>
        <div class="col-xs-8">
            <button type="submit" class="btn btn-success btn-block btn-flat">
                Recuperar senha
            </button>
        </div>
    </div>
    {!! BootForm::close() !!}
    <a href="{{ route('admin.login.form') }}">Voltar</a>
@endsection