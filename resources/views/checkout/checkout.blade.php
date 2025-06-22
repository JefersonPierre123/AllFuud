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
        <div class="row g-0">
            <!-- Coluna 1: Dados do Cliente -->
            <div class="col-lg-3">
                <div class="card card-checkout mb-4">
                    <div class="card-body">
                        <h5 class="h5 mb-3"><span class="count-card">1</span> Dados do Cliente</h5>
                        <p><strong>Nome:</strong> João Silva silva João Sil </p>
                        <p><strong>E-mail:</strong> joao.silva@email.com</p>
                        <p><strong>Telefone:</strong> (11) 98765-4321</p>
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
                                <div class="mb-2">Selecione o endereço:</div>
                                <div class="list-item">
                                    <label class="form-check w-100 align-items-center d-flex" style="cursor:pointer;">
                                        <input class="form-check-input me-2" type="radio" id="enderecoCliente" name="endereco" checked>
                                        <span>Rua teste, 123, Paulista, Campo bom/RS CEP 93700-000 </span>
                                    </label>
                                </div>
                                <div class="list-item">
                                    <label class="form-check w-100 align-items-center d-flex" style="cursor:pointer;">
                                        <input class="form-check-input me-2" type="radio" id="envio-transportadora" name="endereco">
                                        <span>Rua teste, 123, Paulista, Campo bom/RS CEP 93700-000 </span>
                                    </label>
                                </div>
                                <div class="list-item">
                                    <label class="form-check w-100 align-items-center d-flex" style="cursor:pointer;">
                                        <input class="form-check-input me-2" type="radio" id="envio-retirada" name="endereco">
                                        <span>Rua teste, 123, Paulista, Campo bom/RS CEP 93700-000 </span>
                                    </label>
                                </div>
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
                                <div id="cartao-details" class="payment-details show">
                                    <div class="mb-3">
                                        <label for="numero-cartao" class="form-label">Número do Cartão</label>
                                        <input type="text" id="numero-cartao" maxlength="16" class="form-control" placeholder="0000 0000 0000 0000">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nome-cartao" class="form-label">Nome no Cartão</label>
                                        <input type="text" id="nome-cartao" class="form-control" placeholder="Nome impresso no cartão">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validade" class="form-label">Validade (MM/AA)</label>
                                            <input type="text" id="validade" maxlength="4" class="form-control" placeholder="MM/AA">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="number" id="cvv" class="form-control" placeholder="CVV">
                                        </div>
                                    </div>
                                </div>
                                <div id="pix-details" class="payment-details">
                                    <p class="mb-3">Utilize o QR Code ou a chave PIX para finalizar o pagamento:</p>
                                    <div class="bg-light p-3 text-center rounded">
                                        <strong>Chave PIX:</strong> exemplo@pix.com.br
                                        <br><br>
                                        <img src="https://via.placeholder.com/150" alt="QR Code PIX" class="rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Coluna 3: Resumo do Pedido -->
            <div class="col-lg-3">
                <div class="card card-resume">
                    <div class="card-body">
                        <h2 class="h5 mb-3">Resumo do Pedido</h2>
                        <div class="card card-product-checkout card-body h-100 mb-2">
                            <div class="row g-0 h-100">
                                <div class="col-4 col-img">
                                    <img src="{{ asset('storage/images/' ) }}" class="establishment-img" alt="Imagem do Estabelecimento">
                                </div>
                                <div class="col-8">
                                    <div class="card-body d-flex flex-column h-100">
                                        <input type="hidden" name="product_id" value="id">
                                        <p class="card-subtitle mb-1 text-muted">Pizza de mussarella</p>
                                        <h6 class="card-title mb-2 ">R$ 100,00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-product-checkout card-body h-100 mb-2">
                            <div class="row g-0 h-100">
                                <div class="col-4 col-img">
                                    <img src="{{ asset('storage/images//' ) }}" class="establishment-img" alt="Imagem do Estabelecimento">
                                </div>
                                <div class="col-8">
                                    <div class="card-body d-flex flex-column h-100">
                                        <input type="hidden" name="product_id" value="id">
                                        <p class="card-subtitle mb-1 text-muted">Pizza de mussarella</p>
                                        <h6 class="card-title mb-2 ">R$ 100,00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-product-checkout card-body h-100 mb-2">
                            <div class="row g-0 h-100">
                                <div class="col-4 col-img">
                                    <img src="{{ asset('storage/images/' ) }}" class="establishment-img" alt="Imagem do Estabelecimento">
                                </div>
                                <div class="col-8">
                                    <div class="card-body d-flex flex-column h-100">
                                        <input type="hidden" name="product_id" value="id">
                                        <p class="card-subtitle mb-1 text-muted">Pizza de mussarella</p>
                                        <h6 class="card-title mb-2 ">R$ 100,00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span><strong>Valor do pedido:</strong> R$ 400,00</span>
                        <button type="button" class="btn btn-success w-100 py-2 fs-5 mt-2">Finalizar Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const paymentSelect = document.getElementById('forma-pagamento');
        const cartaoDetails = document.getElementById('cartao-details');
        const pixDetails = document.getElementById('pix-details');

        function updatePaymentDetails() {
            if (paymentSelect.value === 'cartao') {
                cartaoDetails.classList.add('show');
                pixDetails.classList.remove('show');
            } else if (paymentSelect.value === 'pix') {
                pixDetails.classList.add('show');
                cartaoDetails.classList.remove('show');
            }
        }

        paymentSelect.addEventListener('change', updatePaymentDetails);
        updatePaymentDetails();
    </script>
    @stack('scripts')
    <x-scripts />
</body>
</html>
