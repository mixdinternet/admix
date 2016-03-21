@extends('admin.master-login')

@section('content')
        {!! BootForm::open(['id' => 'loginForm', 'class' => 'jq-form-validate', 'route' => 'admin.login']) !!}

            <p class="login-box-msg">Preencha corretamente para entrar no sistema</p>

            {!! BootForm::email('email', null, null, ['placeholder' => 'E-mail', 'data-rule-required' => 'true']) !!}

            {!! BootForm::password('password', null, ['placeholder' => 'Senha', 'data-rule-required' => 'true', 'minlength' => 8]) !!}

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox checkbox-flat">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">
                            Lembrar meus dados
                        </label>
                    </div>

                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-success btn-block btn-flat">
                        Entrar
                    </button>
                </div>
            </div>
        {!! BootForm::close() !!}
        <a href="{{ route('admin.recover.view') }}">Esqueci minha senha</a>
@endsection