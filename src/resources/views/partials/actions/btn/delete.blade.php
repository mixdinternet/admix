{!! Form::open(['url' => $route
    , 'method' => 'delete', 'class' => 'destroy jq-form-destroy']) !!}
{!! Form::hidden('id[]', $id) !!}
<button class="btn btn-danger btn-flat btn-xs jq-destroy" type="submit">
    <i class="fa fa-remove visible-xs-inline-block"></i>
    <i class="fs-normal hidden-xs">remover</i>
</button>
{!! Form::close() !!}