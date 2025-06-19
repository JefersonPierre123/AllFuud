{{-- 1. Definimos que o componente espera receber um objeto 'product' --}}
@props(['product'])
<div class="card">
    {{-- 2. Usamos as propriedades do objeto $product --}}
    <div class="card-img-top">
        @if ($product->imagem)
            <img src="{{ asset(path: 'storage/images/products/' . $product->imagem) }}" class="card-img-top w-100"
                alt="Imagem de {{ $product->nome }}">
        @endif
    </div>

    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $product->nome }}</h5>
        <p class="card-text">{{ $product->descricao }}</p>

        <div class="mb-3 mt-auto">
            <p class="card-text">R$ {{ number_format($product->valor, 2, ',', '.') }}</p>
        </div>

        <div id="button-container" class="d-flex flex-column gap-2">
            @guest
                <x-button variant="secondary" icon="bi bi-box-arrow-in-right" size="sm" href="{{ route('login') }}">
                    Acesse sua conta
                </x-button>
            @endguest

            @auth
                @if (Auth::user()->client_id)
                    <form action="{{ route('checkout.createCart') }}" method="POST">
                        @csrf
                        <x-button variant="secondary" icon="bi bi-cart" size="sm" type="submit">
                            Adicionar ao Carrinho
                        </x-button>
                    </form>

                    {{-- Verifica se o usuário logado é o dono DESTE produto específico --}}
                @elseif(Auth::user()->establishment_id === $product->establishment_id)
                    <x-button variant="primary" icon="bi bi-pencil-square" size="sm"
                        onclick="loadProductForm({{ $product->id }})">
                        Atualizar Produto
                    </x-button>
                    @if ($product->ativo)
                        <form action="{{ route('products.deactivate', $product) }}" method="POST" class="d-grid">
                            @csrf
                            @method('PATCH')
                            <x-button type="submit" variant="danger" icon="bi bi-eye-slash" size="sm">
                                Desativar Produto
                            </x-button>
                        </form>
                    @else
                        <form action="{{ route('products.reactivate', $product) }}" method="POST" class="d-grid">
                            @csrf
                            @method('PATCH')
                            <x-button type="submit" variant="success" icon="bi bi-eye" size="sm">
                                Reativar Produto
                            </x-button>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>