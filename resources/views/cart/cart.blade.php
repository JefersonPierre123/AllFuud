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
                    @foreach($items as $index => $item)
                        <tr>
                            <td>
                                @if(!empty($item['imagem']))
                                    <img src="{{ asset(path: 'storage/images/products/' . $item['imagem']) }}" alt="Imagem" style="width: 60px;">
                                @endif
                            </td>
                            <td>{{ $item['nome'] ?? '' }}</td>
                            <td>R$ {{ $item['valor'] ?? '' }}</td>
                            <td>{{ $item['quantidade'] ?? 1 }}</td>
                        </tr>
                        <td>
                            <form action="{{ route('cart.removeItem') }}" method="POST" >
                                @csrf
                                <input type="hidden" name="item_index" value="{{ $index }}">
                                <button type="submit" class="btn btn-danger btn-sm" style="display:inline;">Remover</button>
                            </form>
                        </td>
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