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
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Coluna 1: Dados do Cliente + Endereço -->
            <div class="col-lg-4">
                <div class="card-order p-4">
                    <div class="section-title">Dados do Cliente</div>
                    <p><strong>Nome:</strong> Pedro</p>
                    <p><strong>Telefone:</strong> (56) 99292-0222</p>

                    <hr>

                    <div class="section-title">Endereço de Entrega</div>
                    <p>
                        Rua teste<br>
                        Paulista<br>
                        RS<br>
                        CEP: 12345-678
                    </p>
                </div>
            </div>

            <!-- Coluna 2: Lista de produtos comprados -->
            <div class="col-lg-8">
                <div class="card-order p-4">
                    <div class="section-title">Produtos Comprados</div>
                    <div class="d-flex align-items-center mb-3 pb-2">
                        <div class="me-3">
                            <img src="" class="establishment-img" alt="Imagem do Produto">
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-semibold">Pizza</p>
                            <p class="mb-1 text-muted">Quantidade: 3</p>
                            <p class="mb-0 text-bold">R$ 100</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fs-5">
                        <strong>Total do Pedido:</strong>
                        <strong class="text-bold">R$ 1000</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
