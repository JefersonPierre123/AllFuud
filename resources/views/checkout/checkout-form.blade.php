@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Finalizar Pedido</h2>
        <form action="" method="POST">
            @csrf
            @if (!empty($_COOKIE['cart_token']))
                <div class="alert alert-info">
                    Token do carrinho: {{ $_COOKIE['cart_token'] }}
                </div>
            @endif
            @if(session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif
            {{-- Dados do Cliente --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            {{-- Endereço de Entrega --}}
            <div class="mb-3">
                <label for="address" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>

            {{-- Método de Pagamento --}}
            <div class="mb-3">
                <label class="form-label">Método de Pagamento</label>
                <select class="form-select" name="payment_method" required>
                    <option value="">Selecione</option>
                    <option value="credit_card">Cartão de Crédito</option>
                    <option value="pix">PIX</option>
                    <option value="cash">Dinheiro</option>
                </select>
            </div>

            {{-- Botão de Finalizar --}}
            <button type="submit" class="btn btn-success">Finalizar Pedido</button>
        </form>

        @if(count($items))
    <h4>Itens do Carrinho:</h4>
    @foreach($items as $item)
        <div>
            <img src="{{ $item['imagem'] }}">
            <p>{{ $item['nome'] }}</p>
            <p>{{ $item['valor'] }}</p>
            <p>Quantidade: {{ $item['quantidade'] }}</p>
            <p>Total: {{ $item['valor'] * $item['quantidade'] }}</
        </div>
    @endforeach
@else
    <p>Seu carrinho está vazio.</p>
@endif

    </div>
@endsection