<div class="card card-custom">
    <form action="{{ route('clients.store') }}" method="POST" class="container mt-4">
        @csrf

        <h2 class="text-dark mb-4"><i class="bi bi-person-fill-add me-2"></i>Cadastro de Cliente</h2>
    
        {{-- Grupo: Dados Pessoais --}}
        <div class="form-section-title"><i class="bi bi-card-list me-2"></i>Dados Pessoais</div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00" onblur="verificarCPF()" required>
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome" required disabled>
            </div>
            <div class="col-md-6">
                <label for="surname" class="form-label">Sobrenome</label>
                <input type="text" name="surname" id="surname" class="form-control" placeholder="Sobrenome" required disabled>
            </div>
            <div class="col-md-6">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" required disabled>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="(00) 00000-0000" required disabled>
            </div>
        </div>
    
        <div class="mt-4">
            <x-button variant="primary" type="submit" size="lg">
                <i class="bi bi-send-fill me-1"></i> Cadastrar Dados Pessoais
            </x-button>
        </div>
    </form>
</div>

@if(session('client_id'))
    <div class="card card-custom">
        <form action="{{ route('addresses.store') }}" method="POST" class="container mt-4">
            @csrf

            <h2 class="text-dark mb-4"><i class="bi bi-person-fill-add me-2"></i>Cadastro de Endereço</h2>

            <input type="hidden" id="client_id" name="client_id" value="{{ session('client_id') }}">
            
            {{-- Grupo: Endereço --}}
            <div class="form-section-title"><i class="bi bi-geo-alt-fill me-2"></i>Endereço</div>
                <x-address-registration-form />
        
            <div class="mt-4">
                <x-button variant="primary" type="submit" size="lg">
                    <i class="bi bi-send-fill me-1"></i> Cadastrar Endereço
                </x-button>
            </div>
        </form>
    </div>
@endif

@push('scripts')
    <script src="{{ asset('js/cpf.js') }}"></script>
@endpush