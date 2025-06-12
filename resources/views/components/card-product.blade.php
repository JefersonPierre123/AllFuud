{{-- 1. Definimos que o componente espera receber um objeto 'product' --}}
@props(['product'])

{{-- 2. Usamos as propriedades do objeto $product --}}
@if ($product->imagem)
    <img src="{{ asset(path: 'storage/images/products/' . $product->imagem) }}" class="card-img-top w-100"
        alt="Imagem de {{ $product->nome }}">
@endif

<div class="card-body d-flex flex-column">
    <h5 class="card-title">{{ $product->nome }}</h5>
    <p class="card-text">{{ $product->descricao }}</p>

    <div class="mb-3">
        <p class="card-text">R$ {{ number_format($product->valor, 2, ',', '.') }}</p>
    </div>

    <div id="button-container" class="d-flex flex-column mt-auto gap-2">
        @guest
            <x-button variant="secondary" icon="bi bi-box-arrow-in-right" size="sm" href="{{ route('login') }}">
                Acesse sua conta
            </x-button>
        @endguest

        @auth
            @if (Auth::user()->client_id)
                <x-button variant="secondary" icon="bi bi-cart" size="sm" {{-- Lógica para adicionar ao carrinho --}}>
                    Adicionar ao Carrinho
                </x-button>

                {{-- Verifica se o usuário logado é o dono DESTE produto específico --}}
            @elseif(Auth::user()->establishment_id === $product->establishment_id)
                <x-button variant="primary" icon="bi bi-pencil-square" size="sm"
                    onclick="loadProductForm({{ $product->id }})">
                    Atualizar Produto
                </x-button>
                <x-button variant="danger" icon="bi bi-trash" size="sm" {{-- Lógica para deletar o produto --}}>
                    Excluir Produto
                </x-button>
            @endif
        @endauth
    </div>
</div>
