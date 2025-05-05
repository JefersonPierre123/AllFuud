@extends('layouts.app')

@php
    $restaurants = [
        [
            'image' => 'restaurant-image-placeholder.jpg',
            'title' => 'Pizzaria da Vó',
            'description' => 'A melhor pizza artesanal do bairro com fermentação natural.',
            'classification' => 4.8,
        ],
        [
            'image' => 'restaurant-image-placeholder.jpg',
            'title' => 'Sushi Express',
            'description' => 'Sushis e temakis preparados na hora com ingredientes frescos.',
            'classification' => 4.5,
        ],
        [
            'image' => 'restaurant-image-placeholder.jpg',
            'title' => 'Burguer do Zé',
            'description' => 'Hambúrgueres artesanais com blend especial da casa.',
            'classification' => 4.3,
        ],
        [
            'image' => 'restaurant-image-placeholder.jpg',
            'title' => 'Veg & Go',
            'description' => 'Comida vegana saudável e deliciosa para todos os gostos.',
            'classification' => 4.7,
        ],
        [
            'image' => 'restaurant-image-placeholder.jpg',
            'title' => 'Churrasco Grill',
            'description' => 'Rodízio completo com cortes nobres e buffet livre.',
            'classification' => 4.6,
        ],
    ];
@endphp

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($restaurants as $restaurant)
                <x-card-restaurant                     
                    :image="$restaurant['image']"
                    :title="$restaurant['title']"
                    :description="$restaurant['description']"
                    :classification="$restaurant['classification']" 
                />
        @endforeach
    </div>
</div>
@endsection