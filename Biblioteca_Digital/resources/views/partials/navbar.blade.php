<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom sticky-top" style="backdrop-filter: blur(10px); background-color: rgba(var(--bs-body-bg-rgb), 0.95) !important;">
    <div class="container-fluid px-4">
        <!-- Logo y Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-book text-white fs-5"></i>
            </div>
            <span class="fw-bold fs-5">Biblioteca Digital</span>
        </a>

        <!-- Toggler para móvil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Links centrales -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house me-1"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('repositorio.*') ? 'active fw-semibold' : '' }}" href="{{ route('repositorio.index') }}">
                        <i class="bi bi-collection me-1"></i> Repositorio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inventario.*') ? 'active fw-semibold' : '' }}" href="{{ route('inventario.index') }}">
                        <i class="bi bi-book me-1"></i> Inventario
                    </a>
                </li>
            </ul>

            <!-- Usuario dropdown -->
            @auth
            <div class="dropdown">
                <button class="btn btn-link text-decoration-none p-0" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                            {{ strtoupper(substr(Auth::user()->nombre, 0, 1) . substr(Auth::user()->apellido_paterno, 0, 1)) }}
                        </div>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown" style="min-width: 250px;">
                    <li class="px-3 py-2 border-bottom">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold">{{ Auth::user()->nombre_completo }}</span>
                            <small class="text-muted">{{ Auth::user()->correo }}</small>
                        </div>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('perfil.edit') }}">
                            <i class="bi bi-person me-2"></i> Perfil
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
            </a>
            @endauth
        </div>
    </div>
</nav>

<style>
    .nav-link.active {
        color: var(--bs-primary) !important;
    }
    
    .nav-link:hover {
        color: var(--bs-primary) !important;
    }
    
    .navbar {
        z-index: 1050;
    }
</style>