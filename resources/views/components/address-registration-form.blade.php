@props([
    'routeSuffix',
    'method' => 'POST',
    'routeParams' => [],
    'address' => null,
])

<div class="card card-custom">
    <form action="{{ route('addresses.' . $routeSuffix, $routeParams) }}" method="{{ strtoupper($method) }}" class="container mt-4">

        @if (in_array(strtoupper($method), ['PUT', 'PATCH']))
            @method($method)
        @endif
            @csrf

        <h2 class="text-dark mb-4"><i class="bi bi-person-fill-add me-2"></i>Cadastro de Endereço</h2>

        <input type="hidden" id="client_id" name="client_id" value="{{ $client->id }}">
        
        {{-- Grupo: Endereço --}}
        <div class="form-section-title"><i class="bi bi-geo-alt-fill me-2"></i>Endereço</div>
        <div class="row g-3">
            <div class="col-md-4">
                <label for="cep" class="form-label">CEP</label>
                <input 
                    type="text" 
                    name="cep" 
                    id="cep" 
                    class="form-control" 
                    placeholder="00000-000" 
                    onblur="buscarEndereco()" 
                    value="{{ old('cep', $address->cep ?? '') }}"
                    required
                >
            </div>
            <div class="col-md-4">
                <x-select-uf />
            </div>
            <div class="col-md-6">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" name="city" id="city" class="form-control" required readonly>
            </div>
            <div class="col-md-8">
                <label for="neighborhood" class="form-label">Bairro</label>
                <input type="text" name="neighborhood" id="neighborhood" class="form-control" required readonly>
            </div>
            <div class="col-md-8">
                <label for="street" class="form-label">Endereço</label>
                <input type="text" name="street" id="street" class="form-control" required readonly>
            </div>
            <div class="col-md-8">
                <label for="number" class="form-label">Número</label>
                <input type="text" name="number" id="number" class="form-control" placeholder="0000" 
                value="{{ old('number', $address->numero ?? '') }}"
                required>
            </div>
            <div class="col-md-8">
                <label for="complement" class="form-label">Complemento</label>
                <input type="text" name="complement" id="complement" class="form-control" placeholder="Esquina"
                value="{{ old('complement', $address->complemento ?? '') }}"
                required>
            </div>
        </div>
    
        <div class="mt-4">
            <x-button variant="primary" type="submit" size="lg">
                <i class="bi bi-send-fill me-1"></i> @if($method === 'POST') Cadastrar @else Atualizar @endif Endereço
            </x-button>
            <x-button variant="secondary" size="lg"  onclick="closeAddressForm()">
                <i class="bi bi-x-circle me-1"></i> Cancelar
            </x-button>
        </div>
    </form>
</div>