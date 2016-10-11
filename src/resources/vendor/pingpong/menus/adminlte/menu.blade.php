@foreach ($items as $item)
    @if ($item->hasChilds())
        @include('vendor.pingpong.menus.adminlte.item.dropdown', compact('item'))
    @else
        @include('vendor.pingpong.menus.adminlte.item.item', compact('item'))
    @endif
@endforeach
