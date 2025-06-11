@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            @if ($establishment->products->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        Nenhum produto encontrado para este estabelecimento.
                    </div>
                </div>
            @endif
            @foreach($establishment->products as $product)
                
                <x-card-product
                    :image="$product->imagem"
                    :title="$product->nome"
                    :description="$product->descricao"
                    :price="$product->valor" 
                />
            @endforeach
        </div>
    </div>
@endsection
