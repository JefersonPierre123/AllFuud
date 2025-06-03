@props([
    'address'
])

<div class="card mb-3 shadow-sm border-0">
    <div class="card-body">
        <h5 class="card-title d-flex justify-content-between align-items-center">
            <span><i class="bi bi-geo-alt-fill me-2"></i>Endereço</span>
            <button 
                type="button" 
                class="btn btn-sm btn-outline-primary"
                onclick="loadAddressForm({{ $address->id }})"
            >
                <i class="bi bi-pencil-fill"></i> Editar
            </button>
        </h5>

        <div class="row g-2">
            <div class="col-md-6">
                <p class="mb-0"><strong>CEP:</strong> {{ $address->cep ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0"><strong>UF:</strong> {{ $address->estado ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0"><strong>Cidade:</strong> {{ $address->cidade ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0"><strong>Bairro:</strong> {{ $address->bairro ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0"><strong>Rua:</strong> {{ $address->endereco ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0"><strong>Número:</strong> {{ $address->numero ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0"><strong>Complemento:</strong> {{ $address->complemento ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>