{!! Form::open(['url' => $route
    , 'method' => 'delete', 'class' => 'jq-form-bulk-destroy']) !!}
<button class="btn btn-danger btn-flat jq-destroy-all" type="button">
    <i class="fa fa-remove"></i>
    <i class="fs-normal hidden-xs">Remover selecionados</i>
</button>
{!! Form::close() !!}