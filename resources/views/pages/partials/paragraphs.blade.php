@php
    $lines = $paragraphs ?? page_section_paragraphs($section ?? []);
@endphp

@foreach ($lines as $paragraph)
    <p>{{ $paragraph }}</p>
@endforeach
