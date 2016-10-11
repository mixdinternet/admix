@extends('mixdinternet/admix::form')

@section('title')
    Gerenciar grupos
@endsection

@section('form')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab_geral" data-toggle="tab">Geral</a></li>
        </ul>
        {!! BootForm::horizontal(['model' => $role, 'store' => 'admin.roles.store', 'update' => 'admin.roles.update'
            , 'id' => 'form-model', 'class' => 'form-horizontal form-rocket jq-form-validate jq-form-save'
            , 'files' => true ]) !!}
        <div class="tab-content">
            <div class="tab-pane active" id="tab_geral">
                {!! BootForm::select('status', 'Status', ['active' => 'Ativo', 'inactive' => 'Inativo'], null
                    , ['class' => 'jq-select2', 'data-rule-required' => true]) !!}

                {!! BootForm::text('name', 'Nome', null, ['data-rule-required' => true, 'maxlength' => '150']) !!}

                <div class="form-group @if($errors->has('rules')) has-error @endif">
                    <label for="permissions" class="control-label col-sm-3 col-md-3">Permissões</label>

                    <div class="col-sm-9 col-md-9">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover jq-table-rocket">
                                <thead>
                                @if($errors->has('rules'))
                                    <tr>
                                        <td colspan="6"><label>{{ $errors->first('rules') }}</label></td>
                                    </tr>
                                @endif
                                <tr>
                                    <th></th>
                                    <th>Listar</th>
                                    <th>Inserir</th>
                                    <th>Editar</th>
                                    <th>Remover</th>
                                    <th>Restaurar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($rules as $rule)
                                    <tr>
                                        <td>
                                            {{ $rule->title }}
                                        </td>
                                        <td>
                                            @if (!isset($rule->attributes['except']) || (!in_array('index', $rule->attributes['except'])))
                                                <div class="checkbox checkbox-flat">
                                                    <input type="checkbox" name="rules[]"
                                                           id="checkbox-{{ $rule->url }}.index"
                                                           value="{{ $rule->url }}.index"
                                                           @if(in_array($rule->url . '.index', $role->rules)) checked="checked" @endif>
                                                    <label for="checkbox-{{ $rule->url }}.index">
                                                    </label>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!isset($rule->attributes['except']) || (!in_array('create', $rule->attributes['except'])))
                                                <div class="checkbox checkbox-flat">
                                                    <input type="checkbox" name="rules[]"
                                                           id="checkbox-{{ $rule->url }}.create"
                                                           value="{{ $rule->url }}.create"
                                                           @if(in_array($rule->url . '.create', $role->rules)) checked="checked" @endif>
                                                    <label for="checkbox-{{ $rule->url }}.create">
                                                    </label>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!isset($rule->attributes['except']) || (!in_array('edit', $rule->attributes['except'])))
                                                <div class="checkbox checkbox-flat">
                                                    <input type="checkbox" name="rules[]"
                                                           id="checkbox-{{ $rule->url }}.edit"
                                                           value="{{ $rule->url }}.edit"
                                                           @if(in_array($rule->url . '.edit', $role->rules)) checked="checked" @endif>
                                                    <label for="checkbox-{{ $rule->url }}.edit">
                                                    </label>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!isset($rule->attributes['except']) || (!in_array('destroy', $rule->attributes['except'])))
                                                <div class="checkbox checkbox-flat">
                                                    <input type="checkbox" name="rules[]"
                                                           id="checkbox-{{ $rule->url }}.destroy"
                                                           value="{{ $rule->url }}.destroy"
                                                           @if(in_array($rule->url . '.destroy', $role->rules)) checked="checked" @endif>
                                                    <label for="checkbox-{{ $rule->url }}.destroy">
                                                    </label>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!isset($rule->attributes['except']) || (!in_array('trash', $rule->attributes['except'])))
                                                <div class="checkbox checkbox-flat">
                                                    <input type="checkbox" name="rules[]"
                                                           id="checkbox-{{ $rule->url }}.trash"
                                                           value="{{ $rule->url }}.trash"
                                                           @if(in_array($rule->url . '.trash', $role->rules)) checked="checked" @endif>
                                                    <label for="checkbox-{{ $rule->url }}.trash">
                                                    </label>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection