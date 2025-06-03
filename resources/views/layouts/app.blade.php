<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AllFuud - Seu delivery rápido</title>
        <x-styles />
    </head>
    <body>

        <!-- Navbar -->
        @include('include.navbar')

        <!-- Conteúdo -->
        <main class="container my-4">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>

        <!-- Rodapé -->
        <footer class="text-center">
            <div class="container">
                <span class="text-muted">Projeto WEB desenvolvido como trabalho avaliativo para a matéria de Front End</span>
            </div>
        </footer>

        @stack('scripts')
        <x-scripts />
    </body>
</html>