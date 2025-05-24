@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            @foreach($products as $product)
                    <x-card-product                     
                        :image="$product['imagem']"
                        :title="$product['nome']"
                        :description="$product['descricao']"
                        :price="$product['valor']" 
                    />
            @endforeach
        </div>
    </div>
@endsection
