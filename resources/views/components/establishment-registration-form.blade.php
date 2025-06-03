@props([
    'routeSuffix',
    'method' => 'POST',
    'routeParams' => [],
    'establishment' => null,
])

<div class="card card-custom">
    

    <form action="{{ route('establishments.' . $routeSuffix, $routeParams) }}" method="{{ strtoupper($method) }}" class="container mt-4" enctype="multipart/form-data">

    @if (in_array(strtoupper($method), ['PUT', 'PATCH']))
        @method($method)
    @endif
        @csrf

        <h2 class="mb-4">Cadastro de Estabelecimentos</h2>
    
        {{-- Grupo: Dados do Estabelecimento --}}
        <div class="form-section-title"><i class="bi bi-card-list me-2"></i>Dados do Estabelecimento</div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="cnpj" class="form-label">CNPJ</label>
                <input 
                    type="text" 
                    name="cnpj" 
                    id="cnpj" 
                    class="form-control" 
                    placeholder="AA.AAA.AAA/AAAA-DV" 
                    value="{{ old('cnpj', $establishment->cnpj ?? '') }}"
                    onblur="verificarCNPJ()" 
                    required
                    @if($method === 'PUT') disabled @endif
                >
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Nome da Franquia</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control" 
                    placeholder="Nome da Franquia" value="{{ old('name', $establishment->nome_franquia ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif
                >
            </div>
            <div class="col-md-6">
                <label for="unit_name" class="form-label">Nome da Unidade</label>
                <input 
                    type="text" 
                    name="unit_name" 
                    id="unit_name" 
                    class="form-control" 
                    placeholder="Nome da Unidade" 
                    value="{{ old('unit_name', $establishment->nome_unidade ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif
                >
            </div>
            <div class="col-md-6">
                <label for="description" class="form-label">Descrição</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control" 
                    placeholder="Descreva seu estabelecimento"
                    required
                    @if($method !== 'PUT') disabled @endif
                >{{ old('description', $establishment->descricao ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="image" class="form-label">Imagem do Estabelecimento</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
                <x-select-category />
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone</label>
                <input 
                    type="text" 
                    name="phone" 
                    id="phone" 
                    class="form-control" 
                    placeholder="(00) 00000-0000" 
                    value="{{ old('phone', $establishment->telefone ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif
                >
            </div>
            <div class="col-md-6">
                <label for="contact_email" class="form-label">Email para Contato</label>
                <input 
                    type="email" 
                    name="contact_email" 
                    id="contact_email" 
                    class="form-control" 
                    placeholder="email@exemplo.com" 
                    value="{{ old('contact_email', $establishment->email_contato ?? '') }}"
                    required
                    @if($method !== 'PUT') disabled @endif
                >
            </div>
        </div>
    
        <hr class="my-4">
    
        <div class="form-section-title"><i class="bi bi-card-list me-2"></i>Endereço do Estabelecimento</div>
            {{-- Grupo: Endereço --}}
            <x-establishment-address 
                :establishment="$establishment"
            />

        <div class="mt-4">
            <x-button variant="primary" type="submit" size="lg">
                <i class="bi bi-send-fill me-1"></i> @if($method === 'POST') Cadastrar @else Atualizar @endif Cliente
            </x-button>
        </div>
    </form>
</div>

@push('scripts')
    <script src="{{ asset('js/cnpj.js') }}"></script>
@endpush