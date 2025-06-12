@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endpush

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

        {{-- LOOP CORRIGIDO --}}
        {{-- Cada produto agora tem um "wrapper" com a coluna e os IDs que o JavaScript precisa --}}
        <div class="row product-grid">
            @foreach($establishment->products as $product)
                <div class="col-12 col-md-4 mb-4">
                    <div id="card-product-{{ $product->id }}" class="h-100">
                        <x-card-product :product="$product" />
                    </div>
                    <div id="product-form-container-{{ $product->id }}" class="mt-3 d-none"></div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Container para o formulário de NOVO produto (adicione se ainda não tiver) --}}
    <div id="new-product-form-container" class="mt-4"></div>
@endsection

@push('scripts')
    <script>
        window.productFormBaseUrl = "{{ url('products/form') }}";
    </script>
    <script src="{{ asset('js/render-product-form-container.js') }}"></script>
@endpush
