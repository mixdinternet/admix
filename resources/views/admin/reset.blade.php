@extends('admin.master-login')

@section('content')
    {!! BootForm::open(['id' => 'resetForm', 'class' => 'jq-form-validate', 'route' => 'admin.recover.reset.post']) !!}
    {!! BootForm::hidden('token', $token) !!}

    <p class="login-box-msg">Preencha os dados para resetar sua senha</p>

    {!! BootForm::email('email', null, null, ['data-rule-required' => 'true']) !!}
    {!! BootForm::password('password', 'Nova senha', ['data-rule-required' => 'true', 'minlength' => 8]) !!}
    {!! BootForm::password('password_confirmation', 'Confirme sua senha', ['data-rule-required' => 'true', 'minlength' => 8]) !!}

    <div class="row">
        <div class="col-xs-4">
        </div>
        <div class="col-xs-8">
            <button type="submit" class="btn btn-success btn-block btn-flat">
                Resetar senha
            </button>
        </div>
    </div>
    {!! BootForm::close() !!}
@endsection