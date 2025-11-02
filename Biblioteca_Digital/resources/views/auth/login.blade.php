<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Biblioteca Digital</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/auth-styles.css') }}">
</head>
<body>
    <div class="bg-image login-bg"></div>
    
    <div class="card auth-card" style="width: 100%; max-width: 450px;">
        <div class="card-body p-4 p-sm-5">
            <!-- Logo -->
            <div class="logo-circle">
                <i class="bi bi-book fs-2 text-white"></i>
            </div>
            
            <!-- Título -->
            <h2 class="text-center fw-bold mb-2">Iniciar Sesión</h2>
            <p class="text-center text-muted mb-4">Ingresa tus credenciales para acceder a la biblioteca</p>
            
            <!-- Mensajes -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if($errors->has('login_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first('login_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            <!-- Formulario de LOGIN -->
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="tu@email.com" 
                        required 
                        autofocus
                    >
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required
                    >
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Botón submit -->
                <button type="submit" class="btn btn-primary w-100">
                    Iniciar Sesión
                </button>
            </form>
            
            <!-- Link a registro -->
            <p class="text-center text-muted mb-0 mt-4">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="link-primary text-decoration-none">Regístrate</a>
            </p>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>