<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllFuud - Seu delivery rápido</title>
    @stack('styles')
    <x-styles />
</head>

<body class="bg-light pt-0">
    <div class="container py-5">
        @php
            $client = auth()->user()->client;
            $user = auth()->user();
        @endphp
        <div class="row gx-2 gy-0">
            <!-- Coluna 1: Dados do Cliente -->
            <div class="col-lg-3">
                <div class="card card-checkout mb-4">
                    <div class="card-body">
                        <h5 class="h5 mb-3"><span class="count-card">1</span> Dados do Cliente</h5>
                        <p><strong>Nome:</strong> {{ $client->nome }} </p>
                        <p><strong>E-mail:</strong> {{ $user->email }} </p>
                        <p><strong>Telefone:</strong> {{ $client->telefone }}</p>
                    </div>
                </div>
            </div>
            <!-- Coluna 2: Endereço de entrega e Forma de Pagamento -->
            <div class="col-lg-6">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="card card-checkout mb-2">
                            <div class="card-body">
                                <h2 class="h5 mb-3"><span class="count-card">2</span> Endereço de entrega</h2>
                                @if(!empty($cart->address))
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $cart->address['rua'] ?? '' }},
                                                {{ $cart->address['numero'] ?? '' }}
                                            </h5>
                                            <p class="card-text">
                                                {{ $cart->address['complemento'] ?? '' }}<br>
                                                {{ $cart->address['cidade'] ?? '' }} -
                                                {{ $cart->address['estado'] ?? '' }}<br>
                                                CEP: {{ $cart->address['cep'] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                    <form action="{{ route('checkout.removeAddress') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Trocar endereço</button>
                                    </form>
                                @else
                                    <form action="{{ route('checkout.saveAddress') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="cep" class="form-label">CEP</label>
                                            <input type="text" name="cep" id="cep" class="form-control"
                                                placeholder="00000-000" onblur="buscarEndereco()"
                                                value="{{ old('cep', $address->cep ?? '') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="street" class="form-label">Rua</label>
                                            <input type="text" class="form-control" id="street" name="street" required
                                                readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Cidade</label>
                                            <input type="text" name="city" id="city" class="form-control" required readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="neighborhood" class="form-label">Bairro</label>
                                            <input type="text" name="neighborhood" id="neighborhood" class="form-control"
                                                required readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="state" class="form-label">Estado</label>
                                            <input type="text" name="state" id="state" class="form-control"
                                                placeholder="0000" value="{{ old('number', $address->numero ?? '') }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="number" class="form-label">Número</label>
                                            <input type="text" name="number" id="number" class="form-control"
                                                placeholder="0000" value="{{ old('number', $address->numero ?? '') }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="complement" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="complement" name="complement">
                                        </div>
                                        <button type="submit" class="btn btn-danger">Salvar Endereço de Entrega</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Forma de Pagamento -->
                    <div class="col-12">
                        <div class="card card-checkout mb-4">
                            <div class="card-body">
                                <h2 class="h5 mb-3"><span class="count-card">3</span> Forma de Pagamento</h2>
                                <div class="mb-3">
                                    <label for="forma-pagamento" class="form-label">Escolha a forma de pagamento:</label>
                                    <select id="forma-pagamento" class="form-select w-auto">
                                        <option value="cartao">Cartão de Crédito</option>
                                        <option value="pix">PIX</option>
                                    </select>
                                </div>
                                <form action="{{ route('checkout.resume') }}" method="POST">
                                    @csrf
                                    <div id="cartao-details" class="payment-details show">
                                        <div class="mb-3">
                                            <label for="numero-cartao" class="form-label">Número do Cartão</label>
                                            <input type="text" id="numero-cartao" maxlength="16" class="form-control"
                                                placeholder="0000 0000 0000 0000" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nome-cartao" class="form-label">Nome no Cartão</label>
                                            <input type="text" id="nome-cartao" class="form-control"
                                                placeholder="Nome impresso no cartão" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validade" class="form-label">Validade (MM/AA)</label>
                                                <input type="text" id="validade" maxlength="5" class="form-control"
                                                    placeholder="MM/AA" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cvv" class="form-label">CVV</label>
                                                <input type="number" id="cvv" class="form-control" placeholder="CVV" required maxlength="3">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pix-details" class="payment-details">
                                        <p class="mb-3">Utilize o QR Code ou a chave PIX para finalizar o pagamento:</p>
                                        <div class="bg-light p-3 text-center rounded">
                                            <strong>Chave PIX:</strong> exemplo@pix.com.br
                                            <br><br>
                                            <img src="https://via.placeholder.com/150" alt="QR Code PIX"
                                                class="rounded">
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Coluna 3: Resumo do Pedido -->
            <div class="col-lg-3">
                @php
                    $total = 0;
                @endphp
            <div class="card card-resume">
                <div class="card-body">
                    <h2 class="h5 mb-3">Resumo do Pedido</h2>
                    @foreach ($items as $item)
                        @php
                            $valor = isset($item['valor']) ? floatval($item['valor']) : 0;
                            $quantidade = isset($item['quantidade']) ? intval($item['quantidade']) : 1;
                            $subtotal = $valor * $quantidade;
                            $total += $subtotal;
                        @endphp
                        <div class="card card-product-checkout card-body h-100 mb-2">
                            <div class="row g-0 h-100">
                                <div class="col-4">
                                    <img src="{{ asset(path: 'storage/images/products/' . $item['imagem']) }}" class="establishment-img" alt="Imagem do Estabelecimento">
                                </div>
                                <div class="col-8 ps-2">
                                    <p class="card-subtitle mb-1 text-muted">{{ $item['nome'] }}</p>
                                    <p class="card-subtitle mb-1 text-muted">x{{ $item['quantidade'] }}</p>
                                    <h6 class="card-title text-success mb-2">R$ {{ number_format($subtotal, 2, ',', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total:</strong>
                        <strong class="text-success">R$ {{ number_format($total, 2, ',', '.') }}</strong>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger w-100 mt-4">Finalizar Pedido</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/cep.js') }}"></script>
    <script src="{{ asset('js/payment-methods.js') }}"></script>
    @stack('scripts')
    <x-scripts />
</body>
</html>