@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Meu Carrinho</h2>
    @if(count($items))
        <table class="table">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            @if(!empty($item['imagem']))
                                <img src="{{ $item['imagem'] }}" alt="Imagem" style="width: 60px;">
                            @endif
                        </td>
                        <td>{{ $item['nome'] ?? '' }}</td>
                        <td>R$ {{ $item['valor'] ?? '' }}</td>
                        <td>{{ $item['quantidade'] ?? 1 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('checkout') }}" class="btn btn-success mt-3">
            Finalizar Pedido
        </a>
    @else
        <p>Seu carrinho está vazio.</p>
    @endif
</div>
@endsection