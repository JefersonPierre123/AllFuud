<div class="card">
    <form action="#" class="container mt-4">
        <h2 class="mb-4">Cadastro de Usuário</h2>
    
        {{-- Grupo: Dados Pessoais --}}
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome" required>
            </div>
            <div class="col-md-6">
                <label for="surname" class="form-label">Sobrenome</label>
                <input type="text" name="surname" id="surname" class="form-control" placeholder="Sobrenome" required>
            </div>
            <div class="col-md-6">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00" onblur="verificarCPF()" required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="(00) 00000-0000" required>
            </div>
        </div>
    
        <hr class="my-4">
    
        {{-- Grupo: Login --}}
        <div class="row g-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@exemplo.com" required>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
            </div>
            <div class="col-md-6">
                <label for="confirm_password" class="form-label">Confirmar Senha</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirme a Senha" required>
            </div>
        </div>
    
        <hr class="my-4">
    
        {{-- Grupo: Endereço --}}
        <div class="row g-3">
            <div class="col-md-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" name="cep" id="cep" class="form-control" placeholder="00000-000" onblur="buscarEndereco()" required>
            </div>
            <div class="col-md-4">
                <x-select-uf />
            </div>
            <div class="col-md-6">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <div class="col-md-8">
                <label for="neighborhood" class="form-label">Bairro</label>
                <input type="text" name="neighborhood" id="neighborhood" class="form-control" placeholder="Bairro" required>
            </div>
            <div class="col-md-8">
                <label for="street" class="form-label">Endereço</label>
                <input type="text" name="street" id="street" class="form-control" placeholder="Endereço" required>
            </div>
            <div class="col-md-8">
                <label for="number" class="form-label">Número</label>
                <input type="text" name="number" id="number" class="form-control" placeholder="0000" required>
            </div>
            <div class="col-md-8">
                <label for="complement" class="form-label">Complemento</label>
                <input type="text" name="complement" id="complement" class="form-control" placeholder="Esquina" required>
            </div>
        </div>
    
        <div class="mt-4">
            <x-button variant="primary" type="submit" size="sm">Cadastrar</x-button>
        </div>
    </form>
</div>