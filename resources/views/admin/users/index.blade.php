@extends('admin.index')

@section('title')
    Listagem de usuários
@endsection

@section('btn-insert')
    @if((!checkRule('admin.users.create')) && (!$trash))
        @include('admin.partials.actions.btn.insert', ['route' => route('admin.users.create')])
    @endif
    @if((!checkRule('admin.users.trash')) && (!$trash))
        @include('admin.partials.actions.btn.trash', ['route' => route('admin.users.trash')])
    @endif
    @if($trash)
        @include('admin.partials.actions.btn.list', ['route' => route('admin.users.index')])
    @endif
@endsection

@section('btn-delete-all')
    @if((!checkRule('admin.users.destroy')) && (!$trash))
        @include('admin.partials.actions.btn.delete-all', ['route' => route('admin.users.destroy')])
    @endif
@endsection

@section('search')
    {!! Form::model($search, [
        'route' => ($trash) ? 'admin.users.trash' : 'admin.users.index', 'method' => 'get', 'id' => 'form-search'
        , 'class' => '']) !!}
    <div class="row">
        <div class="col-md-4">
            {!! BootForm::select('status', 'Status', ['' => '-', 'active' => 'Ativo', 'inactive' => 'Inativo'], null
                , ['class' => 'jq-select2']) !!}
        </div>
        <div class="col-md-4">
            {!! BootForm::text('name', 'Nome') !!}
        </div>
        <div class="col-md-4">
            {!! BootForm::text('email', 'Email') !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a href="{{ route(($trash) ? 'admin.users.trash' : 'admin.users.index') }}" class="btn btn-default btn-flat">
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
    @if (count($users) > 0)
        <table class="table table-striped table-hover table-action jq-table-rocket">
            <thead>
            <tr>
                @if((!checkRule('admin.users.destroy')) && (!$trash))
                    <th>
                        <div class="checkbox checkbox-flat">
                            <input type="checkbox" id="checkbox-all">
                            <label for="checkbox-all">
                            </label>
                        </div>
                    </th>
                @endif
                <th>{!! columnSort('#', ['field' => 'users.id', 'sort' => 'asc']) !!}</th>
                <th>{!! columnSort('Nome', ['field' => 'users.name', 'sort' => 'asc']) !!}</th>
                <th>{!! columnSort('Email', ['field' => 'users.email', 'sort' => 'asc']) !!}</th>
                <th>{!! columnSort('Status', ['field' => 'users.status', 'sort' => 'asc']) !!}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    @if((!checkRule('admin.users.destroy')) && (!$trash))
                        <td>
                            @include('admin.partials.actions.checkbox', ['row' => $user])
                        </td>
                    @endif
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@include('admin.partials.label.status', ['status' => $user->status])</td>
                    <td>
                        @if((!checkRule('admin.users.edit')) && (!$trash))
                            @include('admin.partials.actions.btn.edit', ['route' => route('admin.users.edit', $user->id)])
                        @endif
                        @if((!checkRule('admin.users.destroy')) && (!$trash))
                            @include('admin.partials.actions.btn.delete', ['route' => route('admin.users.destroy'), 'id' => $user->id])
                        @endif
                        @if($trash)
                            @include('admin.partials.actions.btn.restore', ['route' => route('admin.users.restore', $user->id)])
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
    {!! $users->appends(request()->except(['page']))->render() !!}
@endsection

@section('pagination-showing')
    @include('admin.partials.pagination-showing', ['model' => $users])
@endsection