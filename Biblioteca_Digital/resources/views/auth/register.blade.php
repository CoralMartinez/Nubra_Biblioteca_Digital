<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Biblioteca Digital</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/auth-styles.css') }}">
</head>
<body>
    <div class="bg-image register-bg"></div>
    
    <div class="card auth-card" style="width: 100%; max-width: 500px; margin: 40px 0;">
        <div class="card-body p-4 p-sm-5">
            <!-- Logo -->
            <div class="logo-circle">
                <i class="bi bi-book fs-2 text-white"></i>
            </div>
            
            <!-- Título -->
            <h2 class="text-center fw-bold mb-2">Crear Cuenta</h2>
            <p class="text-center text-muted mb-4">Completa el formulario para registrarte</p>
            
            <!-- Mensajes -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            <!-- Formulario -->
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input 
                        type="text" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        id="nombre" 
                        name="nombre" 
                        value="{{ old('nombre') }}" 
                        placeholder="Juan" 
                        required
                    >
                    @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Apellidos en dos columnas -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                        <input 
                            type="text" 
                            class="form-control @error('apellido_paterno') is-invalid @enderror" 
                            id="apellido_paterno" 
                            name="apellido_paterno" 
                            value="{{ old('apellido_paterno') }}" 
                            placeholder="Pérez" 
                            required
                        >
                        @error('apellido_paterno')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input 
                            type="text" 
                            class="form-control @error('apellido_materno') is-invalid @enderror" 
                            id="apellido_materno" 
                            name="apellido_materno" 
                            value="{{ old('apellido_materno') }}" 
                            placeholder="García" 
                            required
                        >
                        @error('apellido_materno')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
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
                    >
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Fecha de Nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input 
                        type="date" 
                        class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                        id="fecha_nacimiento" 
                        name="fecha_nacimiento" 
                        value="{{ old('fecha_nacimiento') }}" 
                        required
                    >
                    @error('fecha_nacimiento')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Contraseñas en dos columnas -->
                <div class="row">
                    <div class="col-md-6 mb-3">
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
                    
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="••••••••" 
                            required
                        >
                    </div>
                </div>
                
                <!-- Botón submit -->
                <button type="submit" class="btn btn-primary w-100">
                    Crear Cuenta
                </button>
            </form>
            
            <!-- Link a login -->
            <p class="text-center text-muted mb-0 mt-4">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="link-primary text-decoration-none">Inicia sesión</a>
            </p>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>