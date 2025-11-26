<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Nubra Digital</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-auth.css') }}">
</head>
<body>
    <!-- Background animado -->
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

    <!-- Contenedor principal -->
    <div class="auth-container">
        <div class="auth-layout reverse">
            <!-- Sección de formulario (izquierda) -->
            <div class="form-section">
                <div class="glass-form" style="max-height: 90vh; overflow-y: auto;">
                    <!-- Mensajes de éxito -->
                    @if(session('success'))
                    <div class="glass-alert success">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif

                    <!-- Formulario -->
                    <form action="{{ url('/register') }}" method="POST">
                        @csrf

                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input 
                                type="text" 
                                class="glass-input" 
                                id="nombre" 
                                name="nombre" 
                                value="{{ old('nombre') }}" 
                                placeholder="Juan" 
                                required
                            >
                            @error('nombre')
                            <small style="color: #f56565; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Apellido Paterno -->
                        <div class="form-group">
                            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                            <input 
                                type="text" 
                                class="glass-input" 
                                id="apellido_paterno" 
                                name="apellido_paterno" 
                                value="{{ old('apellido_paterno') }}" 
                                placeholder="Pérez" 
                                required
                            >
                            @error('apellido_paterno')
                            <small style="color: #f56565; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Apellido Materno -->
                        <div class="form-group">
                            <label for="apellido_materno" class="form-label">Apellido Materno</label>
                            <input 
                                type="text" 
                                class="glass-input" 
                                id="apellido_materno" 
                                name="apellido_materno" 
                                value="{{ old('apellido_materno') }}" 
                                placeholder="García" 
                                required
                            >
                            @error('apellido_materno')
                            <small style="color: #f56565; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input 
                                type="email" 
                                class="glass-input" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="tu@email.com" 
                                required
                            >
                            @error('email')
                            <small style="color: #f56565; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="form-group">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input 
                                type="date" 
                                class="glass-input" 
                                id="fecha_nacimiento" 
                                name="fecha_nacimiento" 
                                value="{{ old('fecha_nacimiento') }}" 
                                required
                            >
                            @error('fecha_nacimiento')
                            <small style="color: #f56565; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group">
                            <label for="password" class="form-label">Contraseña</label>
                            <input 
                                type="password" 
                                class="glass-input" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required
                            >
                            @error('password')
                            <small style="color: #f56565; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
                            <input 
                                type="password" 
                                class="glass-input" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="••••••••" 
                                required
                            >
                        </div>

                        <!-- Botón submit -->
                        <button type="submit" class="glass-button">
                            Crear Cuenta
                        </button>
                    </form>

                    <!-- Link a login -->
                    <div class="form-link">
                        <p class="form-link-text">
                            ¿Ya tienes cuenta? 
                            <a href="{{ route('login') }}">Inicia sesión</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sección de branding (derecha) -->
            <div class="branding-section">
                <h1 class="brand-title">Crear Cuenta</h1>
                <p class="brand-description" style="font-size: 1.2rem; line-height: 1.8;">
                    Ingresa a Nubra Digital para acceder a un mundo de posibilidades. 
                    Explora nuestra biblioteca, descubre nuevos conocimientos y gestiona tu experiencia de lectura.
                </p>
                
                <!-- Redes sociales -->
                <div class="social-links">
                    <a href="#" class="social-icon" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-icon" title="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="#" class="social-icon" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>