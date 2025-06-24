@extends('layouts.app')

@section('content')
     <div class="container mt-5">
    <h2 class="mb-4">🛒 Meu Carrinho</h2>

    @if(count($items))
      <div class="row">
        <!-- Coluna de itens do carrinho -->
        <div class="col-lg-8 mb-4">
          @foreach($items as $index => $item)
            <div class="cart-item-card d-flex p-3 bg-white">
              @if(!empty($item['imagem']))
                <img src="{{ asset(path: 'storage/images/products/' . $item['imagem']) }}" alt="Imagem">
              @endif

              <div class="cart-item-body d-flex flex-column justify-content-between">
                <div>
                  <h5 class="mb-1">{{ $item['nome'] ?? '' }}</h5>
                  <div class="cart-price mb-2">R$ {{ $item['valor'] ?? '' }}</div>
                  <div class="text-muted small">Quantidade: {{ $item['quantidade'] ?? 1 }}</div>
                </div>

                <form action="{{ route('cart.removeItem') }}" method="POST" class="mt-2">
                  @csrf
                  <input type="hidden" name="item_index" value="{{ $index }}">
                  <button type="submit" class="btn btn-outline-danger btn-sm remove-btn">
                    Remover
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>

        <div class="col-lg-4">
          <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="mb-3">Resumo do Pedido</h5>

            @php
              $total = 0;
              $quantidadeTotal = 0;
              foreach($items as $item) {
                $total += floatval($item['valor']) * ($item['quantidade']);
                $quantidadeTotal += ($item['quantidade']);
              }
            @endphp

            <p class="mb-1">Itens: <strong>{{ $quantidadeTotal }}</strong></p>
            <p class="mb-3">Total: <span class="cart-price">R$ {{ number_format($total, 2, ',', '.') }}</span></p>
            <div class="d-grid mb-2">
              <a href="{{ route('index') }}" class="btn btn-secondary checkout-btn">
                Continuar comprando
              </a>
            </div>
            <div class="d-grid">
              <a href="{{ route('checkout') }}" class="btn btn-danger checkout-btn">
                Finalizar Pedido
              </a>
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="alert alert-info">Seu carrinho está vazio.</div>
    @endif
  </div>
@endsection