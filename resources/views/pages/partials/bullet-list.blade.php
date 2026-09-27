@php
    $items = $items ?? page_bullet_lines($text ?? null);
@endphp

@if ($items !== [])
    <ul>
        @foreach ($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
@endif
