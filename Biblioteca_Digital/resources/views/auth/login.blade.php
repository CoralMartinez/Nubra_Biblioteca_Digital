<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Nubra Digital</title>
    
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
        <div class="auth-layout">
            <!-- Sección de branding (izquierda) -->
            <div class="branding-section">
                <h1 class="brand-title">Nubra Digital</h1>
                <div class="brand-welcome">Bienvenido de vuelta</div>
                <p class="brand-description">
                    Accede a nuestra colección digital de libros y gestiona el inventario de recursos físicos. 
                    Un mundo de conocimiento te espera.
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

            <!-- Sección de formulario (derecha) -->
            <div class="form-section">
                <div class="form-header">
                    <h2 class="form-title">Iniciar Sesión</h2>
                    <p class="form-subtitle">Ingresa tus credenciales para acceder</p>
                </div>

                <div class="glass-form">
                    <!-- Mensajes de éxito -->
                    @if(session('success'))
                    <div class="glass-alert success">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif

                    <!-- Mensajes de error -->
                    @if($errors->has('login_error'))
                    <div class="glass-alert error">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>{{ $errors->first('login_error') }}</span>
                    </div>
                    @endif

                    <!-- Formulario -->
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf

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
                                autofocus
                            >
                            @error('email')
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

                        <!-- Botón submit -->
                        <button type="submit" class="glass-button">
                            Iniciar Sesión
                        </button>
                    </form>

                    <!-- Link a registro -->
                    <div class="form-link">
                        <p class="form-link-text">
                            ¿No tienes cuenta? 
                            <a href="{{ route('register') }}">Regístrate</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>