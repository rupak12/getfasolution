@php
    $answer = $item['answer'] ?? null;
    $bullets = $item['bullets'] ?? null;
@endphp

@include('pages.partials.plain-text', ['text' => $answer])
@include('pages.partials.bullet-list', ['text' => $bullets])
