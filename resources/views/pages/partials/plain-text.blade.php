@php
    $plain = html_to_plain($text ?? null);
    $blocks = $plain === '' ? [] : (preg_split("/\r\n\r\n|\n\n/", $plain) ?: []);
@endphp

@foreach ($blocks as $block)
    <p>{!! nl2br(e(trim($block))) !!}</p>
@endforeach
