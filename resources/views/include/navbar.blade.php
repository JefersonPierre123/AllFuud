<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">🍔 AllFuud</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if (Auth::user()->establishment_id)
                        <a class="nav-link" href="{{ route('establishments.show', ['establishment' => Auth::user()->establishment_id]) }}">
                            <i class="bi bi-shop me-1"></i>Meu Estabelecimento
                        </a>
                    @else
                        <a class="nav-link" href="{{ route('index') }}">
                            <i class="bi bi-house-door-fill me-1"></i>Início
                        </a>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}"><i class="bi bi-cart-fill me-1"></i>Carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $clientName ?? $establishmentName ?? $authUser?->email }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                            <button type="submit" class="nav-link d-inline">Sair</button>
                        </form>
                    </li>
                @elseguest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}"><i class="bi bi-house-door-fill me-1"></i>Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            Criar Conta
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>