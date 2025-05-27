<div class="card card-custom">
    <form action="#" class="container mt-4">
        <h2 class="mb-4">Cadastro de Estabelecimentos</h2>
    
        {{-- Grupo: Dados do Estabelecimento --}}
        <div class="form-section-title"><i class="bi bi-card-list me-2"></i>Dados do Estabelecimento</div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="cnpj" class="form-label">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="AA.AAA.AAA/AAAA-DV" onblur="verificarCNPJ()" required>
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Nome da Franquia</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome da Franquia" required disabled>
            </div>
            <div class="col-md-6">
                <label for="unit_name" class="form-label">Nome da Unidade</label>
                <input type="text" name="unit_name" id="unit_name" class="form-control" placeholder="Nome da Unidade" required disabled>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="(00) 00000-0000" required disabled>
            </div>
            <div class="col-md-6">
                <label for="contact_email" class="form-label">Email para Contato</label>
                <input type="email" name="contact_email" id="contact_email" class="form-control" placeholder="email@exemplo.com" required disabled>
            </div>
        </div>
    
        <hr class="my-4">
    
        {{-- Grupo: Login --}}
        <div class="form-section-title"><i class="bi bi-lock-fill me-2"></i>Login</div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@exemplo.com" required disabled>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required disabled>
            </div>
            <div class="col-md-6">
                <label for="confirm_password" class="form-label">Confirmar Senha</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirme a Senha" required disabled>
            </div>
        </div>
    
        <hr class="my-4">
    
        {{-- Grupo: Endereço --}}
        <div class="form-section-title"><i class="bi bi-geo-alt-fill me-2"></i>Endereço</div>
        <x-address-registration-form />
    
        <div class="mt-4">
            <x-button variant="primary" type="submit" size="lg">
                <i class="bi bi-send-fill me-1"></i> Cadastrar
            </x-button>
        </div>

    </form>
</div>

@section('scripts')
    <script src="{{ asset('js/cnpj.js') }}"></script>
@endsection