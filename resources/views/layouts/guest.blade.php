<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/guest.css') }}">

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" aria-label="Página inicial">
                    <i class="bi bi-building me-2 fs-4"></i>
                    Controle de Visitas
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Alternar menu de navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="0" aria-label="Sobre">
                                <i class="bi bi-info-circle me-1" aria-hidden="true"></i> Sobre
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contatos.create') }}" tabindex="0" aria-label="Contato">
                                <i class="bi bi-envelope me-1" aria-hidden="true"></i> Contato
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content py-4">
            @yield('content')
        </main>

        <footer class="footer" role="contentinfo">
            <div class="footer-content">
                <div class="copyright" aria-label="Direitos autorais">
                    &copy; {{ date('Y') }} Controle de Visitas. Todos os direitos reservados.
                </div>
                <div class="footer-links" role="navigation" aria-label="Links de rodapé">
                    <a href="#" tabindex="0" aria-label="Política de privacidade"><i class="bi bi-shield-lock me-1"
                            aria-hidden="true"></i> Privacidade</a>
                    <a href="#" tabindex="0" aria-label="Termos de uso"><i class="bi bi-file-text me-1"
                            aria-hidden="true"></i> Termos</a>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>