@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($establishments as $establishment)
                <x-card-establishment                     
                    :image="$establishment['imagem']"
                    :title="$establishment['nome_franquia']"
                    :subtitle="$establishment['nome_unidade']"
                    :category="$establishment['categoria']"
                    :description="$establishment['descricao']"
                    :classification="$establishment['classificacao']"
                />
        @endforeach
    </div>
</div>

{{-- <div class="container mt-5">
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
</div> --}}

<x-user-registration-form />
<x-establishment-registration-form />
@endsection