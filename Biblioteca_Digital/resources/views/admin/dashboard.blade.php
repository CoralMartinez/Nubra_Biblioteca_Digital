@extends('layouts.app-glassmorphism')

@section('title', 'Admin Dashboard - Nubra Digital')

@section('content')
<div class="page-transition-enter">
    
    <!-- Encabezado -->
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: end;">
        <div>
            <h1 class="card-title" style="font-size: 2.5rem; margin-bottom: 0.5rem;">Panel de Control</h1>
            <p class="card-description">Bienvenido, {{ Auth::user()->nombre }}. Aquí tienes el resumen del sistema.</p>
        </div>
        <div>
            <span class="glass-badge primary">
                <i class="bi bi-shield-lock-fill"></i> Modo Administrador
            </span>
        </div>
    </div>

    <!-- Grid de Estadísticas -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <!-- Card Usuarios -->
        <div class="glass-card">
            <div class="card-icon">
                <i class="bi bi-people text-primary"></i>
            </div>
            <h3 class="card-title" style="font-size: 2rem;">{{ $stats['usuarios_totales'] }}</h3>
            <p class="card-description">Usuarios Registrados</p>
            <div style="margin-top: 1rem;">
                <span class="glass-badge" style="background: rgba(72, 187, 120, 0.2); color: #48bb78;">
                    +{{ $stats['nuevos_usuarios'] }} este mes
                </span>
            </div>
        </div>

        <!-- Card Libros -->
        <div class="glass-card">
            <div class="card-icon">
                <i class="bi bi-book text-primary"></i>
            </div>
            <h3 class="card-title" style="font-size: 2rem;">{{ $stats['libros_fisicos'] }}</h3>
            <p class="card-description">Libros Físicos</p>
            <div style="margin-top: 1rem;">
                <a href="{{ route('inventario.create') }}" class="glass-btn glass-btn-sm" style="width: 100%; justify-content: center;">
                    <i class="bi bi-plus-lg"></i> Agregar Nuevo
                </a>
            </div>
        </div>

        <!-- Card Actividad -->
        <div class="glass-card">
            <div class="card-icon">
                <i class="bi bi-activity text-primary"></i>
            </div>
            <h3 class="card-title" style="font-size: 2rem;">{{ $stats['intentos_login'] }}</h3>
            <p class="card-description">Accesos totales</p>
        </div>
    </div>

    <!-- Sección Inferior: Tabla de Usuarios Recientes -->
    <div class="glass-card" style="padding: 0; padding-bottom: 1rem;">
        <div style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title" style="font-size: 1.25rem; margin: 0;">Usuarios Registrados</h3>
            <!-- Botón Nuevo -->
            <button onclick="openUserModal()" class="glass-btn glass-btn-sm">
                <i class="bi bi-person-plus"></i> Nuevo Usuario
            </button>
        </div>
        
        <div class="glass-table-container" style="border: none; border-radius: 0;">
            <table class="glass-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuariosRecientes as $user)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="navbar-avatar" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    {{ strtoupper(substr($user->nombre, 0, 1)) }}
                                </div>
                                <div>
                                    <div>{{ $user->nombre }} {{ $user->apellido_paterno }}</div>
                                    <small style="color: var(--text-muted); font-size: 0.75rem;">{{ $user->apellido_materno }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->correo }}</td>
                        <td>
                            @if($user->rol == 'admin')
                                <span class="glass-badge primary">Admin</span>
                            @else
                                <span class="glass-badge">Usuario</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <div class="table-actions">
                                <button onclick="openUserModal({{ json_encode($user) }})" class="table-btn" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button onclick="deleteUser({{ $user->id }})" class="table-btn" style="color: #f56565;" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div style="padding: 1rem 2rem; display: flex; justify-content: center;">
            {{ $usuariosRecientes->links() }}
        </div>
    </div>
</div>

<!-- ================= MODALES ================= -->

<!-- 1. Modal Crear/Editar Usuario -->
<div id="userModal" class="glass-modal-overlay">
    <div class="glass-modal">
        <div class="modal-header">
            <h3 id="modalTitle" class="modal-title">Nuevo Usuario</h3>
            <button onclick="closeModal('userModal')" class="modal-close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <form id="userForm" method="POST">
            @csrf
            <div id="methodSpoof"></div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="glass-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="glass-input" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" id="apellido_paterno" class="glass-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Apellido Materno</label>
                    <input type="text" name="apellido_materno" id="apellido_materno" class="glass-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="glass-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Rol</label>
                <select name="rol" id="rol" class="glass-input" style="background-color: rgba(0,0,0,0.5);">
                    <option value="usuario" style="color: black;">Usuario General</option>
                    <option value="admin" style="color: black;">Administrador</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Contraseña <small id="passHint" style="color: var(--text-muted); font-weight: normal;"></small></label>
                <input type="password" name="password" id="password" class="glass-input">
            </div>

            <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="button" onclick="closeModal('userModal')" class="glass-btn glass-btn-outline">Cancelar</button>
                <button type="submit" class="glass-btn">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Modal Confirmar Eliminación -->
<div id="deleteModal" class="glass-modal-overlay">
    <div class="glass-modal" style="max-width: 400px;">
        <div class="modal-header">
            <h3 class="modal-title" style="color: #f56565;">Eliminar Usuario</h3>
            <button onclick="closeModal('deleteModal')" class="modal-close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <p style="margin-bottom: 2rem; color: var(--text-muted);">
            ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="button" onclick="closeModal('deleteModal')" class="glass-btn glass-btn-outline">Cancelar</button>
                <button type="submit" class="glass-btn" style="background: linear-gradient(135deg, #f56565 0%, #c53030 100%); border-color: #f56565;">
                    Sí, Eliminar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const routes = {
        store: "{{ route('admin.users.store') }}",
        update: "{{ url('/admin/users') }}", 
        delete: "{{ url('/admin/users') }}"
    };

    function openUserModal(user = null) {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        const title = document.getElementById('modalTitle');
        const passHint = document.getElementById('passHint');
        const methodSpoof = document.getElementById('methodSpoof');

        form.reset();
        methodSpoof.innerHTML = ''; 

        if (user) {
            title.textContent = 'Editar Usuario';
            form.action = `${routes.update}/${user.id}`;
            passHint.textContent = '(Dejar en blanco para mantener la actual)';
            methodSpoof.innerHTML = '<input type="hidden" name="_method" value="PUT">';

            document.getElementById('nombre').value = user.nombre;
            document.getElementById('apellido_paterno').value = user.apellido_paterno;
            document.getElementById('apellido_materno').value = user.apellido_materno || '';
            document.getElementById('email').value = user.correo; 
            document.getElementById('rol').value = user.rol;
            document.getElementById('fecha_nacimiento').value = user.fecha_nacimiento;
            document.getElementById('password').required = false;
        } else {
            title.textContent = 'Nuevo Usuario';
            form.action = routes.store;
            passHint.textContent = '';
            document.getElementById('password').required = true;
        }
        modal.classList.add('active');
    }

    function deleteUser(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `${routes.delete}/${id}`;
        modal.classList.add('active');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }
</script>

<!-- Estilos para la paginación de Laravel en Glassmorphism -->
<style>
    /* Contenedor de la navegación */
    nav[role="navigation"] {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    /* Ocultar información de "Mostrando X de Y" en pantallas muy pequeñas si molesta */
    nav[role="navigation"] p {
        margin-bottom: 0;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* Links de paginación */
    nav[role="navigation"] a, 
    nav[role="navigation"] span[aria-current="page"] span {
        background: transparent !important;
        border: 1px solid var(--glass-border) !important;
        color: var(--text-light) !important;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        margin: 0 2px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    /* Link activo */
    nav[role="navigation"] span[aria-current="page"] span {
        background: var(--primary-brown) !important;
        border-color: var(--primary-brown) !important;
        color: white !important;
    }

    /* Hover en links */
    nav[role="navigation"] a:hover {
        background: rgba(255,255,255,0.1) !important;
        border-color: var(--text-light) !important;
    }

    /* Botones deshabilitados (Anterior/Siguiente cuando no hay más) */
    nav[role="navigation"] span[aria-disabled="true"] span {
        opacity: 0.5;
        cursor: not-allowed;
        border-color: transparent !important;
    }
    
    /* Iconos SVG de Tailwind (flechas) */
    nav[role="navigation"] svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
    }
</style>
@endsection