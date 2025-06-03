<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">🍔 AllFuud</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                     <a class="nav-link" href="#"><i class="bi bi-house-door-fill me-1"></i>Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-journal-text me-1"></i>Cardápio</a>                
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-cart-fill me-1"></i>Carrinho</a>
                </li>
            
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $clientName ?? $establishmentName ?? $authUser?->email }}
                        </a>
                    </li>
                @elseguest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>