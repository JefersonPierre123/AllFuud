@props([
    'type' => 'button',
    'variant' => 'primary',
    'disabled' => false,
    'icon' => null,
    'href' => null,
])

@php
    $classes = "btn btn-$variant";
    if ($disabled) {
        $classes .= ' disabled';
    }
@endphp

@if($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </button>
@endif
