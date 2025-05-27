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
            @yield('content')
        </main>

        <!-- Rodapé -->
        <footer class="text-center">
            <div class="container">
                <span class="text-muted">© 2025 AllFuud - Todos os direitos reservados.</span>
            </div>
        </footer>

        @stack('scripts')
        <x-scripts />
    </body>
</html>