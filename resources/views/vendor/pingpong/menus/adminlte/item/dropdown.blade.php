@if (!$item->hidden())
    <li class="treeview dropdown {{ $item->hasActiveOnChild() ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            @if ($item->icon)<i class="{{ $item->icon }}"></i>@endif
            {{ $item->title }}
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" role="menu">
            @foreach ($item->childs as $child)
                @if ($child->hasChilds())
                    @include('vendor.pingpong.menus.adminlte.child.dropdown', ['item' => $child])
                @else
                    @include('vendor.pingpong.menus.adminlte.item.item', ['item' => $child])
                @endif
            @endforeach
        </ul>
    </li>
@endif