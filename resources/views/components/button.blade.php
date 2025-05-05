@props([
    'type' => 'button',
    'variant' => 'primary',
    'disabled' => false,
    'icon' => null
])

<button
    type="{{ $type }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => "btn btn-$variant"]) }}
>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $slot }}
</button>