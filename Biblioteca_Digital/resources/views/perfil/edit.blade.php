{{-- resources/views/perfil/edit.blade.php --}}

{{-- Asegúrate de usar tu layout principal que carga todos los CSS --}}
@extends('layouts.app-glassmorphism') 

@section('title', 'Editar Perfil')

@section('content')
{{-- Contenedor para centrar la tarjeta, similar al entorno de autenticación --}}
<div class="auth-container" style="min-height: calc(100vh - 120px); align-items: flex-start; padding-top: 4rem;">
    
    <div class="form-section" style="width: 100%;">
        
        {{-- Contenedor principal del Glassmorphism (Clase: glass-form) --}}
        {{-- Usamos la clase 'card-animate' para darle un efecto de entrada suave --}}
        <div class="glass-form mx-auto card-animate" style="max-width: 500px;">
            
            <div class="form-header">
                {{-- Icono de Perfil (Clase: logo-circle de auth-styles) --}}
                <div class="logo-circle" style="width: 64px; height: 64px; margin: 0 auto 1.5rem;">
                    <i class="bi bi-person-circle" style="font-size: 2rem; color: white;"></i>
                </div>
                <h2 class="form-title" style="color: var(--text-light); margin-bottom: 0;">Mi Perfil</h2>
                <p class="form-subtitle">Aquí puedes modificar tu información personal y contraseña.</p>
            </div>

            {{-- Mensajes flash (Clase: glass-alert success) --}}
            @if (session('success'))
                <div class="glass-alert success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            
            {{-- Mensajes de error de validación (Clase: glass-alert error) --}}
            @if($errors->any())
                <div class="glass-alert error" style="align-items: flex-start;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('perfil.update') }}">
                @csrf
                @method('PUT') 
                
                {{-- 1. CAMPO NOMBRE --}}
                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" 
                           class="glass-input @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre', $usuario->nombre) }}" required>
                </div>

                {{-- Contenedor para Apellidos Paterno y Materno en la misma línea --}}
                <div class="form-group row" style="display: flex; gap: 1rem;">
                    {{-- 2. CAMPO APELLIDO PATERNO --}}
                    <div style="flex: 1;">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" 
                               class="glass-input @error('apellido_paterno') is-invalid @enderror"
                               value="{{ old('apellido_paterno', $usuario->apellido_paterno) }}">
                    </div>
                    {{-- 3. CAMPO APELLIDO MATERNO --}}
                    <div style="flex: 1;">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" 
                               class="glass-input @error('apellido_materno') is-invalid @enderror"
                               value="{{ old('apellido_materno', $usuario->apellido_materno) }}">
                    </div>
                </div>

                {{-- 4. CAMPO CORREO --}}
                <div class="form-group">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" 
                           class="glass-input @error('correo') is-invalid @enderror"
                           value="{{ old('correo', $usuario->correo) }}" required>
                </div>

                <hr style="border: 0; border-top: 1px solid var(--glass-border); margin: 2rem 0;">
                
                <h4 class="form-label" style="text-align: center; margin-bottom: 1.5rem;">Cambiar Contraseña</h4>

                {{-- 5. CAMPO CONTRASEÑA (Opcional) --}}
                <div class="form-group">
                    <label for="contrasena" class="form-label">Nueva Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" 
                           class="glass-input @error('contrasena') is-invalid @enderror" 
                           placeholder="Mínimo 8 caracteres (dejar vacío para no cambiar)">
                </div>

                {{-- 6. CAMPO CONFIRMAR CONTRASEÑA --}}
                <div class="form-group">
                    <label for="contrasena_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" id="contrasena_confirmation" name="contrasena_confirmation" 
                           class="glass-input">
                </div>

                {{-- BOTÓN DE SUBMIT (Clase: glass-button) --}}
                <button type="submit" class="glass-button">
                    Actualizar Perfil
                </button>
                
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Estilos mínimos para centrado y error que complementan tus CSS */
    .mx-auto {
        margin-left: auto !important;
        margin-right: auto !important;
    }
    
    .glass-input.is-invalid {
        border-color: #f56565 !important;
        box-shadow: 0 0 10px rgba(245, 101, 101, 0.5) !important;
    }
    
    /* Pequeño ajuste para que el logo-circle de auth-styles.css se vea bien */
    .logo-circle {
        background-color: var(--primary-brown) !important;
    }
</style>
@endpush