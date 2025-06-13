@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        @can('create', App\Models\Product::class)
            <div class="mb-4 text-end">
                <x-button 
                    variant="success" 
                    size="lg" 
                    {{-- Passamos o ID do estabelecimento para a função JS --}}
                    onclick="loadNewProductForm({{ $establishment->id }})"
                >
                    <i class="bi bi-plus-circle-fill me-2"></i> Novo Produto
                </x-button>
            </div>
        @endcan

        <div id="new-product-form-container" class="mt-4"></div>

        {{-- 1. Garanta que a linha principal tenha a classe 'product-grid' --}}
        <div class="row product-grid">
            @if ($establishment->products->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        Nenhum produto encontrado para este estabelecimento.
                    </div>
                </div>
            @else
                @foreach ($establishment->products as $product)
                    {{-- A estrutura do loop continua a mesma --}}
                    <div class="col-12 col-md-4 mb-4">
                        <div id="card-product-{{ $product->id }}">
                            {{-- O componente x-card-product agora não tem h-100 --}}
                            <x-card-product :product="$product" />
                        </div>
                        <div id="product-form-container-{{ $product->id }}" class="d-none"></div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.productFormBaseUrl = "{{ url('products/form') }}";
    </script>
    <script src="{{ asset('js/render-product-form-container.js') }}"></script>
    <script src="{{ asset('js/align-card-height.js') }}"></script>
@endpush
