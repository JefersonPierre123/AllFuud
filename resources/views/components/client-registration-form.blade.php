@props([
    'routeSuffix',
    'method' => 'POST',
    'routeParams' => [],
    'client' => null,
    'clientId' => null,
])

<div class="card card-custom">

    <form action="{{ route('clients.' . $routeSuffix, $routeParams) }}" method="POST" class="container mt-4">

    @if (in_array(strtoupper($method), ['PUT', 'PATCH']))
        @method($method)
    @endif
        @csrf

        <h2 class="text-dark mb-4"><i class="bi bi-person-fill-add me-2"></i>Cadastro de Cliente</h2>
    
        {{-- Grupo: Dados Pessoais --}}
        <div class="form-section-title"><i class="bi bi-card-list me-2"></i>Dados Pessoais</div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF</label>
                <input 
                    type="text" 
                    name="cpf" 
                    id="cpf" 
                    class="form-control" 
                    placeholder="000.000.000-00" 
                    value="{{ old('cpf', $client->cpf ?? '') }}"
                    onblur="verificarCPF()"
                    required
                    @if($method === 'PUT') readonly @endif
                >
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control" 
                    placeholder="Nome" 
                    value="{{ old('name', $client->nome ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif
                >
            </div>
            <div class="col-md-6">
                <label for="surname" class="form-label">Sobrenome</label>
                <input 
                    type="text" 
                    name="surname" 
                    id="surname" 
                    class="form-control" 
                    placeholder="Sobrenome" 
                    value="{{ old('surname', $client->sobrenome ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif 
                >
            </div>
            <div class="col-md-6">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <input 
                    type="date" 
                    name="birth_date" 
                    id="birth_date" 
                    class="form-control" 
                    value="{{ old('birth_date', $client->nascimento ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif
                >
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone</label>
                <input 
                    type="text" 
                    name="phone" 
                    class="form-control" 
                    id="phone" placeholder="(00) 00000-0000" 
                    value="{{ old('phone', $client->telefone ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif
                >
            </div>
        </div>
    
        <div class="mt-4">
            <x-button variant="primary" type="submit" size="lg">
                <i class="bi bi-send-fill me-1"></i> @if($method === 'POST') Cadastrar @else Atualizar @endif Cliente
            </x-button>
        </div>
    </form>
</div>

@if($client)
    <div id="address-list-container">
        <div class="mt-4">
            <x-button 
                variant="success" 
                size="lg" 
                onclick="loadNewAddressForm({{ $clientId }})"
            >
                <i class="bi bi-plus-circle-fill me-2"></i> Novo Endereço
            </x-button>
        </div>
        <div id="new-address-form-container" class="mt-4"></div>
        @if(!empty($client->addresses))
            <div class="row">
                @foreach($client->addresses->sortByDesc('padrao') as $address)
                    <div class="col-md-6 mb-4" id="card-address-wrapper-{{ $address->id }}">
                        <div id="card-address-{{ $address->id }}" class="card card-custom">
                            <x-card-address :address="$address" />
                        </div>
                        <div id="address-form-container-{{ $address->id }}" class="mt-3 d-none"></div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info mt-3" id="no-address-alert">
                Nenhum endereço cadastrado no momento.
            </div>
        @endif
    </div>
@endif


@push('scripts')
    <script>
        window.addressFormBaseUrl = "{{ url('addresses/form') }}";
    </script>
    <script src="{{ asset('js/cpf.js') }}"></script>
    <script src="{{ asset('js/render-address-form-container.js')}}"></script>
    <script src="{{ asset('js/cep.js') }}"></script>
@endpush