?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro - Biblioteca Digital</title>
  <style>
    body { 
      font-family: Arial; 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display:flex; 
      justify-content:center; 
      align-items:center; 
      min-height:100vh;
      margin: 0;
      padding: 20px;
    }
    .form-container { 
      background:white; 
      padding:30px; 
      border-radius:15px; 
      width:400px; 
      max-width: 100%;
      box-shadow:0 10px 40px rgba(0,0,0,0.2); 
    }
    h3 { 
      text-align:center; 
      color:#333; 
      margin-bottom:25px;
      font-size: 24px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      color: #555;
      font-size: 14px;
      font-weight: 500;
    }
    input { 
      width:100%; 
      padding:12px; 
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s;
      box-sizing: border-box;
    }
    input:focus {
      outline: none;
      border-color: #667eea;
    }
    .error { 
      color:#e74c3c; 
      font-size:12px;
      margin-top: 5px;
    }
    button { 
      width:100%; 
      padding:14px; 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color:white; 
      border:none; 
      border-radius:8px; 
      cursor:pointer;
      font-size: 16px;
      font-weight: 600;
      margin-top: 10px;
      transition: transform 0.2s;
    }
    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .link-container { 
      text-align:center; 
      margin-top:20px; 
    }
    a { 
      color:#667eea; 
      text-decoration:none;
      font-weight: 500;
    }
    a:hover {
      text-decoration: underline;
    }
    .success {
      background-color: #d4edda;
      color: #155724;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <form action="{{ url('/register') }}" method="POST">
      @csrf
      <h3>📚 Registro - Biblioteca Digital</h3>

      @if(session('success'))
        <div class="success">{{ session('success') }}</div>
      @endif

      <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        @error('nombre')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Apellido Paterno</label>
        <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
        @error('apellido_paterno')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Apellido Materno</label>
        <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
        @error('apellido_materno')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Correo Electrónico</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
        @error('fecha_nacimiento')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="password" required>
        @error('password')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" required>
      </div>

      <button type="submit">Crear Cuenta</button>

      <div class="link-container">
        <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
      </div>
    </form>
  </div>
</body>
</html>
<?php