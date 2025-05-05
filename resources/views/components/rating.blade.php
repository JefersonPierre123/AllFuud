@php
    $rating = floatval($value);
    $fullStars = floor($rating);
    $halfStar = $rating - $fullStars >= 0.5;
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
@endphp

<div class="mb-3">
    <span class="card-text">

        {{-- Estrelas cheias --}}
        @for ($i = 0; $i < $fullStars; $i++)
            <i class="fa fa-star text-warning"></i>
        @endfor

        {{-- Meia estrela --}}
        @if ($halfStar)
            <i class="fa fa-star-half-alt text-warning"></i>
        @endif

        {{-- Estrelas vazias --}}
        @for ($i = 0; $i < $emptyStars; $i++)
            <i class="fa fa-star-o text-warning"></i>
        @endfor
    </span>
</div>