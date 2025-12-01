<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Nubra Digital')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-animations.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Background animado con partículas -->
    <div class="animated-background">
        <div class="parallax-layer layer-1"></div>
        <div class="parallax-layer layer-2"></div>
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <!-- Navbar flotante -->
    <nav class="glass-navbar">
        <!-- Brand -->
        <a href="{{ route('home') }}" class="navbar-brand">
            <div class="navbar-logo">
                <i class="bi bi-book"></i>
            </div>
            <span class="navbar-title">Nubra Digital</span>
        </a>

        <!-- Menú -->
        <ul class="navbar-menu">
            <li class="navbar-item">
                <a href="{{ route('home') }}" class="navbar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="bi bi-house"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="navbar-item">
                <a href="{{ route('repositorio.index') }}" class="navbar-link {{ request()->routeIs('repositorio.*') ? 'active' : '' }}">
                    <i class="bi bi-collection"></i>
                    <span>Repositorio</span>
                </a>
            </li>
            <li class="navbar-item">
                <a href="{{ route('inventario.index') }}" class="navbar-link {{ request()->routeIs('inventario.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i>
                    <span>Inventario</span>
                </a>
            </li>
        </ul>

        <!-- Usuario -->
        <div class="navbar-user">
            @auth
            <div class="navbar-item" style="position: relative;">
                <div class="navbar-avatar">
                    {{ strtoupper(substr(Auth::user()->nombre, 0, 1) . substr(Auth::user()->apellido_paterno, 0, 1)) }}
                </div>
                
                <!-- Dropdown -->
                <div class="navbar-dropdown">
                    <div class="dropdown-item" style="flex-direction: column; align-items: flex-start; gap: 0.25rem; pointer-events: none;">
                        <span style="font-weight: 600;">{{ Auth::user()->nombre_completo }}</span>
                        <small style="color: var(--text-muted); font-size: 0.8rem;">{{ Auth::user()->correo }}</small>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('perfil.edit') }}" class="dropdown-item">
                        <i class="bi bi-person"></i>
                        <span>Mi Perfil</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item danger" style="width: 100%; background: none; border: none; cursor: pointer;">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="glass-btn glass-btn-sm">
                Iniciar Sesión
            </a>
            @endauth
            
            <!-- Toggle hamburguesa -->
            <button class="navbar-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main style="padding-top: 6rem; min-height: calc(100vh - 300px);">
        <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
            <!-- Mensajes flash -->
            @if(session('success'))
            <div class="glass-alert success" style="margin-bottom: 2rem;">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="glass-alert error" style="margin-bottom: 2rem;">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="glass-alert error" style="margin-bottom: 2rem;">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Contenido de la página -->
            @yield('content')
        </div>
    </main>

    <!-- Footer glassmorphism -->
    <footer class="glass-footer">
        <div class="footer-container">
            <div class="footer-content">
                <!-- Columna 1: Sobre nosotros -->
                <div class="footer-section">
                    <h3>Nubra Digital</h3>
                    <p style="color: var(--text-muted); line-height: 1.6;">
                        Tu biblioteca digital de confianza. Accede a miles de libros y gestiona tu colección física.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="footer-social-icon" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="footer-social-icon" title="Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" class="footer-social-icon" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Columna 2: Enlaces rápidos -->
                <div class="footer-section">
                    <h3>Enlaces Rápidos</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('repositorio.index') }}">Repositorio Digital</a></li>
                        <li><a href="{{ route('inventario.index') }}">Inventario Físico</a></li>
                        <li><a href="#">Catálogo</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Acerca de -->
                <div class="footer-section">
                    <h3>Acerca de</h3>
                    <ul>
                        <li><a href="#">Sobre Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                    </ul>
                </div>

                <!-- Columna 4: Sucursales -->
                <div class="footer-section">
                    <h3>Sucursales</h3>
                    <ul>
                        <li style="color: var(--text-muted); margin-bottom: 0.75rem;">
                            <strong style="color: var(--text-light);">Sede Principal</strong><br>
                            Av. Universidad #123<br>
                            Querétaro, México
                        </li>
                        <li style="color: var(--text-muted);">
                            <strong style="color: var(--text-light);">Sucursal Centro</strong><br>
                            Calle Independencia #456<br>
                            Querétaro, México
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Nubra Digital. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/page-transitions.js') }}"></script>
    
    @stack('scripts')

    <style>
        /* Estilos adicionales para alertas */
        .glass-alert {
            padding: 1rem 1.25rem;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            animation: slideUp 0.5s ease;
        }

        .glass-alert.success {
            background: rgba(72, 187, 120, 0.1);
            border-color: rgba(72, 187, 120, 0.3);
            color: #48bb78;
        }

        .glass-alert.error {
            background: rgba(245, 101, 101, 0.1);
            border-color: rgba(245, 101, 101, 0.3);
            color: #f56565;
        }

        .glass-alert i {
            font-size: 1.25rem;
            flex-shrink: 0;
            margin-top: 0.1rem;
        }
    </style>
</body>
</html>