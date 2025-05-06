@extends('layouts.app')

@php
    $establishments = [
        [
            'image' => 'establishment-image-placeholder.jpg',
            'title' => 'Pizzaria da Vó',
            'description' => 'A melhor pizza artesanal do bairro com fermentação natural.',
            'classification' => 4.8,
        ],
        [
            'image' => 'establishment-image-placeholder.jpg',
            'title' => 'Sushi Express',
            'description' => 'Sushis e temakis preparados na hora com ingredientes frescos.',
            'classification' => 4.5,
        ],
        [
            'image' => 'establishment-image-placeholder.jpg',
            'title' => 'Burguer do Zé',
            'description' => 'Hambúrgueres artesanais com blend especial da casa.',
            'classification' => 4.3,
        ],
        [
            'image' => 'establishment-image-placeholder.jpg',
            'title' => 'Veg & Go',
            'description' => 'Comida vegana saudável e deliciosa para todos os gostos.',
            'classification' => 4.7,
        ],
        [
            'image' => 'establishment-image-placeholder.jpg',
            'title' => 'Churrasco Grill',
            'description' => 'Rodízio completo com cortes nobres e buffet livre.',
            'classification' => 4.6,
        ],
    ];

    $products = [
    [
        'image' => 'food-image-placeholder.jpg',
        'title' => 'Feijoada Completa',
        'description' => 'Tradicional prato brasileiro com feijão preto, carnes defumadas e acompanhamentos.',
        'price' => 'R$ 39,90',
    ],
    [
        'image' => 'food-image-placeholder.jpg',
        'title' => 'Lasanha à Bolonhesa',
        'description' => 'Camadas de massa com molho de carne, queijo e molho bechamel gratinado.',
        'price' => 'R$ 34,90',
    ],
    [
        'image' => 'food-image-placeholder.jpg',
        'title' => 'Combo Sushi 20 Peças',
        'description' => 'Seleção de sushis e sashimis variados com molho shoyu e gengibre.',
        'price' => 'R$ 49,90',
    ],
    [
        'image' => 'food-image-placeholder.jpg',
        'title' => 'Hambúrguer Artesanal',
        'description' => 'Pão brioche, carne premium, queijo cheddar, bacon crocante e maionese da casa.',
        'price' => 'R$ 29,90',
    ],
    [
        'image' => 'food-image-placeholder.jpg',
        'title' => 'Salada Grega',
        'description' => 'Alface, tomate, pepino, cebola roxa, azeitonas e queijo feta temperados com azeite.',
        'price' => 'R$ 24,90',
    ],
];

@endphp

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($establishments as $establishment)
                <x-card-establishment                     
                    :image="$establishment['image']"
                    :title="$establishment['title']"
                    :description="$establishment['description']"
                    :classification="$establishment['classification']" 
                />
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        @foreach($products as $product)
                <x-card-product                     
                    :image="$product['image']"
                    :title="$product['title']"
                    :description="$product['description']"
                    :price="$product['price']" 
                />
        @endforeach
    </div>
</div>

<x-user-registration-form />
<x-establishment-registration-form />
@endsection