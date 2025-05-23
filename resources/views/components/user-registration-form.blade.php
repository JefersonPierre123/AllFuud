<div class="card">
    <form action="#" class="container mt-4">
        <h2 class="mb-4">Cadastro de Usuário</h2>
    
        {{-- Grupo: Dados Pessoais --}}
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
    
        <hr class="my-4">
    
        {{-- Grupo: Login --}}
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
        <x-address-registration-form />
    
        <div class="mt-4">
            <x-button variant="primary" type="submit" size="sm">Cadastrar</x-button>
        </div>
    </form>
</div>

@section('scripts')
    <script src="{{ asset('js/cpf.js') }}"></script>
@endsection