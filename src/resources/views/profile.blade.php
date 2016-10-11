@extends('mixdinternet/admix::form')


@section('title')
    Atualizar seus dados
@endsection

@section('form')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab_geral" data-toggle="tab">Geral</a></li>
        </ul>
        {!! BootForm::horizontal(['model' => $user, 'update' => 'admin.profile.update'
            , 'id' => 'form-model', 'class' => 'form-horizontal form-rocket jq-form-validate jq-form-save'
            , 'files' => true ]) !!}
        <div class="tab-content">
            <div class="tab-pane active" id="tab_geral">
                {!! BootForm::text('name', 'Nome', null, ['data-rule-required' => true, 'maxlength' => '150']) !!}

                {!! BootForm::file('image', 'Imagem', [
                        'data-allowed-file-extensions' => '["jpg", "png"]',
                        'data-initial-preview' => '["<img src=\"' . ((auth()->user()->image->url('crop')) ? : '/assets/img/avatar.png') . '\" class=\"file-preview-image\">"]',
                        'data-initial-caption' => $user->image->originalFilename(),
                        'data-min-image-width' => 200,
                        'data-min-image-height' => 200,
                        'data-aspect-ratio' => 1
                    ]) !!}

                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-offset-3 col-sm-9 col-md-9">
                        <a class="btn-sm btn-primary flat" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Alterar senha
                        </a>
                    </div>
                </div>
                <div class="collapse" id="collapseExample">
                    {!! BootForm::password('password', 'Senha', ['maxlength' => '150', 'minlength' => '8']) !!}

                    {!! BootForm::password('password-confirmation', 'Confirmar Senha', ['maxlength' => '150', 'minlength' => '8']) !!}
                </div>

                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection