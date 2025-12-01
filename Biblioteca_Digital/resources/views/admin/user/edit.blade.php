@extends('admin.dashboard')

@section('title', 'Editar Usuario: ' . $user->nombre)

@section('content')
<div class="header" style="margin-bottom: 30px;">
    <h1>Editar Usuario: {{ $user->nombre }}</h1>
    <a href="{{ route('admin.users.index') }}" class="logout-btn" style="background: #34495e; border-color: #34495e;">
        <i class="bi bi-arrow-left"></i> Volver al Listado
    </a>
</div>

<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    
    {{-- Manejo de Errores de Validación --}}
    @if ($errors->any())
        <div class="glass-alert error" style="margin-bottom: 20px;">
            <i class="bi bi-x-octagon-fill"></i>
            <span>Por favor, corrige los siguientes errores:</span>
            <ul style="margin-top: 10px; margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $user->nombre) }}" required>
        </div>
        
        <div class="form-group">
            <label for="apellido_paterno">Apellido Paterno</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno', $user->apellido_paterno) }}" required>
        </div>
        
        <div class="form-group">
            <label for="apellido_materno">Apellido Materno (Opcional)</label>
            <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno', $user->apellido_materno) }}">
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo', $user->correo) }}" required>
        </div>
        
        <hr style="border-top: 1px solid var(--glass-border); margin: 30px 0;">
        <p style="color: var(--text-muted); margin-bottom: 20px;">**Deja los campos de contraseña vacíos si no deseas cambiarlas.**</p>
        
        <div class="form-group">
            <label for="contrasena">Nueva Contraseña</label>
            <input type="password" id="contrasena" name="contrasena">
        </div>
        
        <div class="form-group">
            <label for="contrasena_confirmation">Confirmar Nueva Contraseña</label>
            <input type="password" id="contrasena_confirmation" name="contrasena_confirmation">
        </div>
        
        <div class="form-group checkbox-group">
            <input type="checkbox" id="activo" name="activo" value="1" {{ old('activo', $user->activo) ? 'checked' : '' }}>
            <label for="activo">Usuario Activo</label>
        </div>

        <button type="submit" class="logout-btn" style="width: 100%; margin-top: 20px;">
            <i class="bi bi-save"></i> Actualizar Usuario
        </button>
    </form>
</div>
@endsection

{{-- Los estilos de formulario van aquí o en tu archivo CSS principal --}}
@push('styles')
<style>
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        display: block;
        color: var(--text-light);
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 1.05rem;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
        width: 100%;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--glass-border);
        border-radius: 10px;
        color: var(--text-light);
        font-size: 1rem;
        transition: border-color 0.3s, background 0.3s;
    }

    .form-group input:focus {
        border-color: var(--primary-brown);
        background: rgba(255, 255, 255, 0.1);
        outline: none;
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-group input[type="checkbox"] {
        transform: scale(1.5);
        accent-color: var(--primary-brown);
    }
    
    .glass-alert {
        padding: 15px 20px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
        font-weight: 600;
        backdrop-filter: blur(5px);
        border: 1px solid;
    }
    
    .glass-alert.error {
        background-color: rgba(231, 76, 60, 0.1);
        border-color: #E74C3C;
        color: #E74C3C;
    }
</style>
@endpush