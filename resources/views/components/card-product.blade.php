{{-- 1. Definimos que o componente espera receber um objeto 'product' --}}
@props(['product'])

{{-- 2. Usamos as propriedades do objeto $product --}}
<div class="product-card card mb-4">
    @if ($product->imagem)
        <img
            src="{{ asset(path: 'storage/images/products/' . $product->imagem) }}"
            alt="Imagem de {{ $product->nome }}"
        />
    @endif

    <div class="p-3 d-flex flex-column h-100">
        <h5 class="mb-2">{{ $product->nome }}</h5>
        <p class="text-muted small mb-2">{{ $product->descricao }}</p>

        <div class="product-price mb-3 mt-auto">
            R$ {{ number_format($product->valor, 2, ',', '.') }}
        </div>

        <div id="button-container" class="d-grid gap-2">
            @guest
                <x-button variant="secondary" icon="bi bi-box-arrow-in-right" size="sm" href="{{ route('login') }}" class="product-btn">
                    Acesse sua conta
                </x-button>
            @endguest

            @auth
                @if (Auth::user()->client_id)
                    <form action="{{ route('checkout.createCart') }}" method="POST">
                        @csrf
                        <x-button variant="secondary" icon="bi bi-cart" size="sm" type="submit" class="product-btn">
                            Adicionar ao Carrinho
                        </x-button>
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    </form>
                {{-- Verifica se o usuário logado é o dono DESTE produto específico --}}
                @elseif (Auth::user()->establishment_id === $product->establishment_id)
                    <x-button variant="primary" icon="bi bi-pencil-square" size="sm" onclick="loadProductForm({{ $product->id }})" class="product-btn">
                        Atualizar Produto
                    </x-button>

                    @if ($product->ativo)
                        <form action="{{ route('products.deactivate', $product) }}" method="POST" class="d-grid">
                            @csrf
                            @method('PATCH')
                            <x-button type="submit" variant="danger" icon="bi bi-eye-slash" size="sm" class="product-btn">
                                Desativar Produto
                            </x-button>
                        </form>
                    @else
                        <form action="{{ route('products.reactivate', $product) }}" method="POST" class="d-grid">
                            @csrf
                            @method('PATCH')
                            <x-button type="submit" variant="success" icon="bi bi-eye" size="sm" class="product-btn">
                                Reativar Produto
                            </x-button>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>