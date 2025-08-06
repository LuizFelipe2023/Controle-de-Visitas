<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }} - Painel Administrativo</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="btn rounded-circle" id="sidebarToggle" aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSistema">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <div class="d-none d-md-block">
                                        <div class="fw-bold text-white">{{ auth()->user()->name }}</div>
                                        <small class="text-white">{{ auth()->user()->email }}</small>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-circle me-2"></i> Perfil
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Sair
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>

                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <aside id="sidebar" class="shadow">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand d-flex align-items-center justify-content-center p-3">
                <i class="bi bi-building me-2 fs-4"></i>
                <span class="fs-4 sidebar-text">Controle de Visitas</span>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('visitas.index') }}"
                    class="nav-link {{ request()->routeIs('visitas.*') && !request()->routeIs('visitas.dia') && !request()->routeIs('visitas.graficos') ? 'active' : '' }}"
                    title="Visitas">
                    <i class="bi bi-people me-2"></i>
                    <span class="sidebar-text">Visitas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('visitas.dia') }}"
                    class="nav-link {{ request()->routeIs('visitas.dia') ? 'active' : '' }}" title="Visitas do Dia">
                    <i class="bi bi-calendar me-2"></i>
                    <span class="sidebar-text">Visitas do Dia</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('visitas.graficos') }}"
                    class="nav-link {{ request()->routeIs('visitas.graficos') ? 'active' : '' }}" title="Gráficos">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    <span class="sidebar-text">Gráficos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" title="Usuários">
                    <i class="bi bi-person me-2"></i>
                    <span class="sidebar-text">Usuários</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logs.index') }}" class="nav-link {{ request()->routeIs('logs.*') ? 'active' : '' }}"
                    title="Logs">
                    <i class="bi bi-clock me-2"></i>
                    <span class="sidebar-text">Logs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('versionamentos.index') }}"
                    class="nav-link {{ request()->routeIs('versionamentos.*') ? 'active' : '' }}"
                    title="Versionamentos">
                    <i class="bi bi-code-slash me-2"></i>
                    <span class="sidebar-text">Versionamentos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('feedbacks.index') }}"
                    class="nav-link {{ request()->routeIs('feedbacks.*') ? 'active' : '' }}" title="Feedbacks">
                    <i class="bi bi-chat-dots me-2"></i>
                    <span class="sidebar-text">Feedbacks</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contatos.index') }}"
                    class="nav-link {{ request()->routeIs('contatos.*') ? 'active' : '' }}" title="Contatos">
                    <i class="bi bi-telephone me-2"></i>
                    <span class="sidebar-text">Contatos</span>
                </a>
            </li>
        </ul>
    </aside>

    <main class="content-wrapper">
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    @stack('scripts')

    <script src="{{ asset('js/sidebar/handleSidebar.js') }}"></script>
</body>

</html>