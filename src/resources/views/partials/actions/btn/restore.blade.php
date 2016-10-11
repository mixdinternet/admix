{!! Form::open(['url' => $route
    , 'method' => 'post', 'class' => '']) !!}
<button class="btn btn-warning btn-flat btn-xs" type="submit">
    <i class="fa fa-undo visible-xs-inline-block"></i>
    <i class="fs-normal hidden-xs">restaurar</i>
</button>
{!! Form::close() !!}