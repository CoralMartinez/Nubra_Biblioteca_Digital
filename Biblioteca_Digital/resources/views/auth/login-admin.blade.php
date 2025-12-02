<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo - Nubra Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/glassmorphism-auth.css') }}">
    <style>
        /* Ajuste específico para centrar el login de admin */
        .admin-layout {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }
        .admin-card {
            width: 100%;
            max-width: 450px;
        }
        .brand-badge {
            background: rgba(139, 111, 71, 0.2);
            color: #8b6f47;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
            border: 1px solid rgba(139, 111, 71, 0.3);
        }
    </style>
</head>
<body>
    <div class="animated-background">
        <div class="parallax-layer layer-1"></div>
        <div class="particles"><div class="particle"></div><div class="particle"></div></div>
    </div>

    <div class="auth-container">
        <div class="admin-layout">
            <div class="glass-form admin-card">
                <div class="form-header">
                    <div class="brand-badge">Modo Administrador</div>
                    <h2 class="form-title">Bienvenido</h2>
                    <p class="form-subtitle">Gestión de Nubra Digital</p>
                </div>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    
                    @if($errors->any())
                    <div class="glass-alert error">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>{{ $errors->first('login_error') ?: 'Credenciales incorrectas' }}</span>
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Correo Administrativo</label>
                        <input type="email" class="glass-input" name="email" required autofocus placeholder="admin@nubra.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="glass-input" name="password" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="glass-button">
                        Ingresar al Panel
                    </button>
                    
                    <div class="form-link">
                        <p class="form-link-text"><a href="{{ route('home') }}">← Volver al sitio principal</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>