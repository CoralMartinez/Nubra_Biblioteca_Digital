
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión - Nubra</title>
  <style>
    body { 
      font-family: Arial; 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display:flex; 
      justify-content:center; 
      align-items:center; 
      height:100vh;
      margin: 0;
    }
    .form-container { 
      background:white; 
      padding:40px; 
      border-radius:15px; 
      width:350px; 
      box-shadow:0 10px 40px rgba(0,0,0,0.2); 
    }
    h3 { 
      text-align:center; 
      color:#333; 
      margin-bottom:30px;
      font-size: 24px;
    }
    .form-group {
      margin-bottom: 20px;
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
    .error { 
      color:white;
      background-color: #e74c3c;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
      font-size: 14px;
    }
    .success {
      background-color: #d4edda;
      color: #155724;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <form action="{{ url('/login') }}" method="POST">
      @csrf
      <h3>📚 Biblioteca Digital</h3>

      @if(session('success'))
        <div class="success">{{ session('success') }}</div>
      @endif

      @if ($errors->has('login_error'))
        <div class="error">{{ $errors->first('login_error') }}</div>
      @endif

      <div class="form-group">
        <label>Correo Electrónico</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
          <div style="color:#e74c3c; font-size:12px; margin-top:5px;">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="password" required>
        @error('password')
          <div style="color:#e74c3c; font-size:12px; margin-top:5px;">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit">Iniciar Sesión</button>

      <div class="link-container">
        <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
      </div>
    </form>
  </div>
</body>
</html>
<?php