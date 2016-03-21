@if ($item->isDivider())
    <li class="divider"></li>
@elseif ($item->isHeader())
    <li class="dropdown-header">{{ $item->title }}</li>
@else
    @if (!$item->hidden())
        <li class="{{ $item->isActive() ? 'active' : '' }}">
            <a href="{{ $item->getUrl() }}" {!! $item->getAttributes() !!}>
                {!! $item->getIcon() !!}
                {{ $item->title }}
            </a>
        </li>
    @endif
@endif
