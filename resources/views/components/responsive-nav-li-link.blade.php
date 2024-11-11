@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-active'
            : '';
@endphp
<li class="{{ $classes }}">
    <a {{ $attributes->merge(['class' => '']) }}>
        {{ $slot }}
    </a>
</li>
