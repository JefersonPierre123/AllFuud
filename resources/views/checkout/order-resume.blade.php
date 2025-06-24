<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pedido Confirmado | AllFuud</title>
    @stack('styles')
    <x-styles />
</head>

<body class="py-5">
    <div class="container">
        <h2 class="mb-4 text-danger">🎉 Pedido Confirmado!</h2>

        <div class="row g-4 mb-2">
            <div class="col-12">
                <div class="card-order p-4 mb-2 align-items-center text-center">
                    <div class="section-title text-danger">⏳ Pedido sendo preparado</div>
                    <p><strong>Previsão de entrega:</strong> 25 - 35 minutos</p>
                    <p><strong>Atendente responsável:</strong> Carlos Henrique</p>
                    <p class="text-muted small">Fique tranquilo! Assim que sair para entrega, avisaremos por aqui.</p>
                    <div class="spinner-border text-danger me-2" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <div>
                        <a href="{{ route('index') }}" class="btn btn-danger mt-2">Voltar para o inicio</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Coluna 1: Dados do Cliente + Endereço -->
            <div class="col-lg-4">
                <div class="card-order p-4">
                    <div class="section-title">Dados do Cliente</div>
                    <p><strong>Nome:</strong> {{ $client->nome ?? 'Não informado' }}</p>
                    <p><strong>Telefone:</strong> {{ $client->telefone ?? 'Não informado' }}</p>

                    <hr>

                    <div class="section-title">Endereço de Entrega</div>
                    @if($address)
                        <p>{{ $address['rua'] ?? '' }}, {{ $address['numero'] ?? '' }}</p>
                        <p><strong>Complemento:</strong> {{ $address['complemento'] ?? '' }}</p>
                        <p>{{ $address['cidade'] ?? '' }} - {{ $address['estado'] ?? '' }}</p>
                        <p>CEP: {{ $address['cep'] ?? '' }}</p>
                    @else
                        <p>Nenhum endereço cadastrado.</p>
                    @endif
                </div>
            </div>

            <!-- Coluna 2: Lista de produtos comprados -->
            <div class="col-lg-8">
                <div class="card-order p-4">
                    <div class="section-title">Produtos Comprados</div>
                        @php $total = 0; @endphp
                        @foreach($items as $item)
                        @php
                            $valor = isset($item['valor']) ? floatval($item['valor']) : 0;
                            $quantidade = isset($item['quantidade']) ? intval($item['quantidade']) : 1;
                            $subtotal = $valor * $quantidade;
                            $total += $subtotal;
                        @endphp
                    <div class="d-flex align-items-center mb-3 pb-2">
                        <div class="me-3">
                            <img src="{{ asset(path: 'storage/images/products/' . $item['imagem']) }}" class="establishment-img" alt="Imagem do Produto">
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-semibold">{{ $item['nome'] }}</p>
                            <p class="mb-1 text-muted">Quantidade: {{ $item['quantidade'] }}</p>
                            <p class="mb-0 text-bold">R$ ${{ $item['valor'] }}</p>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fs-5">
                        <strong>Total do Pedido:</strong>
                        <strong class="text-bold">R$ {{ $total }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>