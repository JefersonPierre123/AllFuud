@props([
    'routeSuffix',
    'method' => 'POST',
    'routeParams' => [],
    'client' => null,
])

<div class="card card-custom">

    <form action="{{ route('clients.' . $routeSuffix, $routeParams) }}" method="{{ strtoupper($method) }}" class="container mt-4">

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
                    @if($method === 'PUT') disabled @endif
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
    @if($method === 'PUT')
        <x-address-registration-form 
        routeSuffix="update" 
        method="PUT" 
        :routeParams="[$authUser->client_id]" 
        :addresses="$client->adresses"/>
    @elseif($method === 'POST')
        <x-address-registration-form 
        routeSuffix="store" 
        method="POST" 
        :routeParams="[]" />
    @endif
@endif

@push('scripts')
    <script src="{{ asset('js/cpf.js') }}"></script>
@endpush