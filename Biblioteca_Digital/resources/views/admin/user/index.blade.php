@extends('admin.dashboard') {{-- Usando tu layout principal: resources/views/admin/dashboard.blade.php --}}

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="header" style="margin-bottom: 30px;">
    <div>
        <h1><i class="bi bi-people-fill"></i> Gestión de Usuarios</h1>
        <p style="margin-top: 5px;">Administra todos los usuarios del sistema (excepto el administrador principal).</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="logout-btn" style="background: var(--primary-brown); border-color: var(--primary-brown);">
        <i class="bi bi-person-plus-fill"></i>
        Añadir Usuario
    </a>
</div>

{{-- Manejo de Mensajes Flash --}}
@if (session('success'))
    <div class="glass-alert success" style="margin-bottom: 20px;">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div class="glass-alert error" style="margin-bottom: 20px;">
        <i class="bi bi-x-octagon-fill"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="glass-card" style="padding: 0;">
    <table class="glass-table">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Role</th> {{-- Título de la columna --}}
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->nombre }} {{ $user->apellido_paterno }} {{ $user->apellido_materno }}</td>
                <td>{{ $user->correo }}</td>
                <td>
                    @if ($user->activo)
                        <span style="color: #2ECC71; font-weight: 600;">Activo</span>
                    @else
                        <span style="color: #E74C3C; font-weight: 600;">Inactivo</span>
                    @endif
                </td>
                {{-- CELDA DEL ROLE CORREGIDA --}}
                <td>
                    {{-- Usa $user->role (la columna correcta) --}}
                    <span style="font-weight: 600;">{{ Str::ucfirst($user->role ?? 'N/A') }}</span>
                </td>
                {{-- FIN DE CELDA ROLE --}}
                <td class="actions-cell">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="glass-button edit-button" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a este usuario? Esta acción no se puede deshacer.');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="glass-button delete-button" title="Eliminar">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                {{-- Colspan ajustado a 5 columnas --}}
                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">No hay usuarios registrados (aparte del administrador).</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('styles')
<style>
    /* Estilos adicionales que ya habías proporcionado */
    .glass-table {
        width: 100%;
        border-collapse: collapse;
        color: var(--text-light);
    }

    .glass-table th, .glass-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid var(--glass-border);
    }
    
    .glass-table th {
        color: var(--primary-brown);
        text-transform: uppercase;
        font-size: 0.85rem;
        font-weight: 700;
    }
    
    .glass-table tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.03); 
    }

    .actions-cell {
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: flex-start;
    }

    .glass-button {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--glass-border);
        color: var(--text-light);
        padding: 8px 12px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s, transform 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    
    .glass-button:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .edit-button {
        color: #3498db;
    }
    
    .delete-button {
        color: #e74c3c;
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
@endpush