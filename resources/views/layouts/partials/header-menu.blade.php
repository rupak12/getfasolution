@php
    $current = trim($__env->yieldContent('current_page'));
@endphp

@foreach ($menuItems as $menuItem)
    @if ($menuItem->isDropdown())
        <li class="has-dropdown">
            <a href="{{ $menuItem->resolvedUrl() }}">{{ $menuItem->title }}</a>
            <ul class="dropdown">
                @foreach ($menuItem->activeChildren as $child)
                    <li>
                        <a href="{{ $child->resolvedUrl() }}">{{ $child->title }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a href="{{ $menuItem->resolvedUrl() }}" class="{{ $menuItem->activeClass($current) }}">
                {{ $menuItem->title }}
            </a>
        </li>
    @endif
@endforeach
