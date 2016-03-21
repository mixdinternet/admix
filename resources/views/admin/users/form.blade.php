@extends('admin.form')

@section('title')
    Gerenciar usuários
@endsection

@section('form')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab_geral" data-toggle="tab">Geral</a></li>
        </ul>
        {!! BootForm::horizontal(['model' => $user, 'store' => 'admin.users.store', 'update' => 'admin.users.update'
            , 'id' => 'form-model', 'class' => 'form-horizontal form-rocket jq-form-validate jq-form-save'
            , 'files' => true ]) !!}
        <div class="tab-content">
            <div class="tab-pane active" id="tab_geral">
                {!! BootForm::select('status', 'Status', ['active' => 'Ativo', 'inactive' => 'Inativo'], null
                    , ['class' => 'jq-select2', 'data-rule-required' => true]) !!}

                {!! BootForm::text('name', 'Nome', null, ['data-rule-required' => true, 'maxlength' => '150']) !!}

                {!! BootForm::email('email', 'Email', null, ['data-rule-required' => true, 'maxlength' => '150']) !!}

                {!! BootForm::file('image', 'Imagem', [
                        'data-allowed-file-extensions' => '["jpg", "png"]',
                        'data-initial-preview' => '["<img src=\"' . $user->image->url('crop') . '\" class=\"file-preview-image\">"]',
                        'data-initial-caption' => $user->image->originalFilename(),
                        'data-min-image-width' => 200,
                        'data-min-image-height' => 200,
                        'data-aspect-ratio' => 1
                    ]) !!}

                {!! BootForm::password('password', 'Senha', ['maxlength' => '150', 'minlength' => '8']) !!}

                {!! BootForm::password('password-confirmation', 'Confirmar Senha', ['maxlength' => '150', 'minlength' => '8']) !!}

                {!! BootForm::select('role_id', 'Grupo', array_merge(['0' => 'Administrador'], $roles), null
                    , ['class' => 'jq-select2', 'data-rule-required' => true]) !!}

                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection