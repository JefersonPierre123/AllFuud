@extends('layouts.app')

<div class="card card-custom">
        {{-- Exibe mensagens de erro de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}" class="container mt-4">
        @csrf
        <div class="form-section-title"><i class="bi bi-lock-fill me-2"></i>Informações de Acesso</div>
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
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirme a Senha" required>
            </div>
        </div>
        <div class="mt-4">
            <x-button variant="danger" type="submit" size="lg">Cadastrar</x-button>
        </div>
    </form>
</div>