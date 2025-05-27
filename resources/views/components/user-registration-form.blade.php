<div class="card card-custom">
    <form action="#" class="container mt-4">
            
        {{-- Grupo: Login --}}
        <div class="form-section-title"><i class="bi bi-lock-fill me-2"></i>Informações de Acesso</div>
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
        <div class="mt-4">
            <x-button variant="danger" type="submit" size="lg">Cadastrar</x-button>
        </div>
    </form>
</div>
