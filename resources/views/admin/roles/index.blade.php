@extends('admin.index')

@section('title')
    Listagem de grupos
@endsection

@section('btn-insert')
    @if(!checkRule('admin.roles.create'))
        @include('admin.partials.actions.btn.insert', ['route' => route('admin.roles.create'), 'title' => 'Grupos'])
    @endif
@endsection

@section('btn-delete-all')
    @if(!checkRule('admin.roles.destroy'))
        @include('admin.partials.actions.btn.delete-all', ['route' => 'admin.roles.destroy'])
    @endif
@endsection

@section('search')
    {!! Form::model($search, ['route' => 'admin.roles.index', 'method' => 'get', 'id' => 'form-search'
        , 'class' => '']) !!}

    <div class="row">
        <div class="col-md-4">
            {!! BootForm::select('status', 'Status', ['' => '-', 'active' => 'Ativo', 'inactive' => 'Inativo'], null
                , ['class' => 'jq-select2']) !!}
        </div>
        <div class="col-md-4">
            {!! BootForm::text('name', 'Nome') !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-flat">
                    <i class="fa fa-list"></i>
                    <i class="fs-normal hidden-xs">Mostrar tudo</i>
                </a>
                <button class="btn btn-success btn-flat">
                    <i class="fa fa-search"></i>
                    <i class="fs-normal hidden-xs">Buscar</i>
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('table')
    @if (count($roles) > 0)
        <table class="table table-striped table-hover table-action jq-table-rocket">
            <thead>
            <tr>
                @if(!checkRule('admin.roles.destroy'))
                    <th>
                        <div class="checkbox checkbox-flat">
                            <input type="checkbox" id="checkbox-all">
                            <label for="checkbox-all">
                            </label>
                        </div>
                    </th>
                @endif
                <th>#</th>
                <th>Nome</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    @if(!checkRule('admin.roles.destroy'))
                        <td>
                            @include('admin.partials.actions.checkbox', ['row' => $role])
                        </td>
                    @endif
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>@include('admin.partials.label.status', ['status' => $role->status])</td>
                    <td>
                        @if(!checkRule('admin.roles.edit'))
                            @include('admin.partials.actions.btn.edit', ['route' => route('admin.roles.edit', $role->id), 'title' => 'Permissão'])
                        @endif
                        @if(!checkRule('admin.roles.destroy'))
                            @include('admin.partials.actions.btn.delete', ['route' => 'admin.roles.destroy', 'id' => $role->id])
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        @include('admin.partials.nothing-found')
    @endif
@endsection

@section('pagination')
    {!! $roles->appends($search)->render() !!}
@endsection