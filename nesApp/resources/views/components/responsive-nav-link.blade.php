@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nes-text is-success'
            : 'nes-text is-error';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
