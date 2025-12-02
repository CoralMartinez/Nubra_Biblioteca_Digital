<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | Nubra Digital</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="{{ asset('css/auth-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-components.css') }}">
    
    {{-- Stack para estilos específicos de cada vista --}}
    @stack('styles')
    
    <style>
        /* Variables Globales (Usadas en todas las vistas) */
        :root {
            --sidebar-width: 250px;
            --primary-brown: #CD853F;
            --text-light: #E0E0E0;
            --text-muted: rgba(255, 255, 255, 0.6);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            --transition-speed: 0.3s;
        }

        /* 1. Estructura General */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;
            background: none !important;
            display: flex;
        }

        /* 2. Layout Principal (Sidebar + Contenido) */
        .admin-layout-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* 3. Sidebar (Panel de Navegación) */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--glass-bg); 
            backdrop-filter: blur(15px);
            border-right: 1px solid var(--glass-border);
            position: fixed;
            height: 100%;
            padding: 30px 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 0 20px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 20px;
        }
        
        .sidebar-header h3 {
            color: var(--text-light);
            font-weight: 700;
            margin-bottom: 0.25rem;
            font-size: 1.5rem;
        }

        /* 4. Menú de Navegación */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: var(--text-light);
            text-decoration: none;
            transition: background var(--transition-speed), color var(--transition-speed);
        }
        
        .sidebar-menu a i {
            margin-right: 15px;
            font-size: 1.2rem;
            color: var(--text-muted);
        }
        
        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-left: 5px solid var(--primary-brown);
            padding-left: 15px;
        }

        .sidebar-menu a.active i {
            color: white;
        }


        /* 5. Contenido Principal */
        .admin-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 40px;
            width: calc(100% - var(--sidebar-width));
            z-index: 1;
            /* Añadido para habilitar el scroll */
            overflow-y: auto; 
        }
        
        /* 6. Estilos de Tarjetas (Comunes) */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            color: var(--text-light);
            padding: 30px;
        }

        /* 7. Estilos del Header (Común a Dashboard y CRUDs) */
        .header {
            background: var(--glass-bg); 
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            padding: 25px 35px;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        /* 8. Estilos de Alertas (para mensajes flash) */
        .glass-alert {
            padding: 15px 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 600;
            backdrop-filter: blur(5px);
            border: 1px solid;
            color: var(--text-light);
        }
        
        .glass-alert.success {
            background-color: rgba(46, 204, 113, 0.1);
            border-color: #2ECC71;
            color: #2ECC71;
        }
        
        .glass-alert.error {
            background-color: rgba(231, 76, 60, 0.1);
            border-color: #E74C3C;
            color: #E74C3C;
        }

    </style>
</head>
<body>
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
    
    <div class="admin-layout-container">
        
        {{-- 2. Sidebar --}}
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h3 style="color: var(--primary-brown);"><i class="bi bi-gear-fill"></i> Panel Admin</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Gestión de Nubra Digital</p>
            </div>

            <ul class="sidebar-menu">
                <li>
                    {{-- Panel Principal --}}
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        Panel Principal
                    </a>
                </li>
                
                <li>
                    {{-- GESTIÓN DE USUARIOS --}}
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-person-lines-fill"></i>
                        Gestión de Usuarios
                    </a>
                </li>
                
                <li>
                    {{-- GESTIÓN DE INVENTARIO (Ruta corregida) --}}
                    {{-- Usamos 'inventario.index' sin 'admin.' según la última configuración de rutas. --}}
                    <a href="{{ route('inventario.index') }}" class="{{ request()->routeIs('inventario.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        Gestión de Inventario
                    </a>
                </li>


                {{-- Cerrar Sesión (CORREGIDO para funcionar como botón POST) --}}
                <li style="margin-top: auto; padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.05);">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="
                            background: none; 
                            border: none; 
                            width: 100%; 
                            text-align: left; 
                            padding: 0.75rem 20px;
                            color: #e74c3c;
                            cursor: pointer;
                            transition: background 0.3s;
                        ">
                            <i class="bi bi-box-arrow-right" style="margin-right: 15px; font-size: 1.2rem;"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        {{-- 3. Contenido Principal --}}
        <main class="admin-content">
            {{-- Mensajes flash (éxito/error) --}}
            @if(session('success'))
            <div class="glass-alert success" style="margin-bottom: 2rem;">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="glass-alert error" style="margin-bottom: 2rem;">
                <i class="bi bi-x-octagon-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif
            
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>