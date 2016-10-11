@if ($model->total() > 0)
    {{( $model->currentpage()-1) * $model->perpage() + 1 }} até
    @if ($model->total() <= ($model->currentpage() * $model->perpage()))
        {{ $model->total() }}
    @else
        {{ $model->currentpage() * $model->perpage() }}
    @endif
    de {{ $model->total() }}
    @if ($model->total() > 1)
        itens
    @else
        item
    @endif
@endif