@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Resumo do Pedido</h2>

    <div class="card mb-3">
        <div class="card-header">Dados do Cliente</div>
        <div class="card-body">
            <p><strong>Nome:</strong> {{ $client->nome ?? 'Não informado' }}</p>
            <p><strong>Telefone:</strong> {{ $client->telefone ?? 'Não informado' }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Endereço de Entrega</div>
        <div class="card-body">
            @if($address)
                <p>{{ $address['rua'] ?? '' }}, {{ $address['numero'] ?? '' }}</p>
                <p>{{ $address['complemento'] ?? '' }}</p>
                <p>{{ $address['cidade'] ?? '' }} - {{ $address['estado'] ?? '' }}</p>
                <p>CEP: {{ $address['cep'] ?? '' }}</p>
            @else
                <p>Nenhum endereço cadastrado.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Itens do Carrinho</div>
        <div class="card-body">
            @if(count($items))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Quantidade</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($items as $item)
                            @php
                                $valor = isset($item['valor']) ? floatval($item['valor']) : 0;
                                $quantidade = isset($item['quantidade']) ? intval($item['quantidade']) : 1;
                                $subtotal = $valor * $quantidade;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $item['nome'] ?? '' }}</td>
                                <td>R$ {{ number_format($valor, 2, ',', '.') }}</td>
                                <td>{{ $quantidade }}</td>
                                <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5>Total: R$ {{ number_format($total, 2, ',', '.') }}</h5>
            @else
                <p>Seu carrinho está vazio.</p>
            @endif
        </div>
    </div>
</div>
@endsection