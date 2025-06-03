@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-center py-5">
        <div class="col-md-4">
            <h2 class="mb-4 text-center">Registro</h2>

            {{-- Exibe mensagens de erro de validação --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email@exemplo.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirme a Senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('login') }}">Já tem uma conta? Faça login</a>
            </div>
        </div>
    </div>
@endsection