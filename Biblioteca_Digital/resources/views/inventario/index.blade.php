@extends('layouts.app-glassmorphism')

@section('title', 'Inventario Físico - Nubra Digital')

@section('content')
<div class="inventory-container">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 3rem; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-light);">
                Inventario Físico
            </h1>
            <p style="color: var(--text-muted); font-size: 1.1rem;">
                Gestiona el catálogo de libros físicos de la biblioteca
            </p>
        </div>
        <button onclick="openModal('addBookModal')" class="glass-btn ripple">
            <i class="bi bi-plus-circle"></i>
            <span>Agregar Libro</span>
        </button>
    </div>

    <!-- Tabla de libros -->
    <div class="glass-table-container card-animate">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--glass-border);">
            <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.25rem; color: var(--text-light);">
                Catálogo de Libros
            </h2>
            <p style="font-size: 0.9rem; color: var(--text-muted);">
                {{ $libros->total() }} {{ $libros->total() === 1 ? 'libro registrado' : 'libros registrados' }}
            </p>
        </div>

        <div style="overflow-x: auto;">
            <table class="glass-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Año</th>
                        <th>Clasificación</th>
                        <th>Ubicación</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($libros as $libro)
                    <tr>
                        <td style="font-weight: 600; color: var(--text-light);">{{ $libro->titulo }}</td>
                        <td>{{ $libro->autor }}</td>
                        <td>{{ $libro->año }}</td>
                        <td>
                            <span class="glass-badge">{{ $libro->clasificacion }}</span>
                        </td>
                        <td>{{ $libro->ubicacion }}</td>
                        <td>
                            <div class="table-actions" style="justify-content: flex-end;">
                                <button 
                                    onclick="openEditModal({{ $libro->id }}, '{{ addslashes($libro->titulo) }}', '{{ addslashes($libro->autor) }}', {{ $libro->año }}, '{{ $libro->clasificacion }}', '{{ $libro->ubicacion }}')" 
                                    class="table-btn" 
                                    data-tooltip="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button 
                                    onclick="openDeleteModal({{ $libro->id }}, '{{ addslashes($libro->titulo) }}', '{{ addslashes($libro->autor) }}')" 
                                    class="table-btn" 
                                    data-tooltip="Eliminar"
                                    style="color: #f56565;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                            <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.5;"></i>
                            No hay libros registrados en el inventario
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if($libros->hasPages())
        <div style="padding: 1.5rem; border-top: 1px solid var(--glass-border);">
            <div class="pagination-glass">
                {{ $libros->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Agregar Libro -->
<div id="addBookModal" class="glass-modal-overlay">
    <div class="glass-modal">
        <div class="modal-header">
            <h2 class="modal-title">Agregar Nuevo Libro</h2>
            <button onclick="closeModal('addBookModal')" class="modal-close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <form action="{{ route('inventario.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="add_titulo" class="form-label">Título</label>
                <input type="text" class="glass-input" id="add_titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="add_autor" class="form-label">Autor</label>
                <input type="text" class="glass-input" id="add_autor" name="autor" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="add_año" class="form-label">Año</label>
                    <input type="number" class="glass-input" id="add_año" name="año" value="{{ date('Y') }}" min="1000" max="{{ date('Y') + 1 }}" required>
                </div>

                <div class="form-group">
                    <label for="add_clasificacion" class="form-label">Clasificación</label>
                    <input type="text" class="glass-input" id="add_clasificacion" name="clasificacion" placeholder="ej: 863.64" required>
                </div>
            </div>

            <div class="form-group">
                <label for="add_ubicacion" class="form-label">Ubicación</label>
                <input type="text" class="glass-input" id="add_ubicacion" name="ubicacion" placeholder="ej: Estante A-12" required>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="button" onclick="closeModal('addBookModal')" class="glass-btn glass-btn-outline" style="flex: 1;">
                    Cancelar
                </button>
                <button type="submit" class="glass-btn ripple" style="flex: 1;">
                    <i class="bi bi-check-circle"></i>
                    Agregar Libro
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Libro -->
<div id="editBookModal" class="glass-modal-overlay">
    <div class="glass-modal">
        <div class="modal-header">
            <h2 class="modal-title">Editar Libro</h2>
            <button onclick="closeModal('editBookModal')" class="modal-close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_titulo" class="form-label">Título</label>
                <input type="text" class="glass-input" id="edit_titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="edit_autor" class="form-label">Autor</label>
                <input type="text" class="glass-input" id="edit_autor" name="autor" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="edit_año" class="form-label">Año</label>
                    <input type="number" class="glass-input" id="edit_año" name="año" min="1000" max="{{ date('Y') + 1 }}" required>
                </div>

                <div class="form-group">
                    <label for="edit_clasificacion" class="form-label">Clasificación</label>
                    <input type="text" class="glass-input" id="edit_clasificacion" name="clasificacion" required>
                </div>
            </div>

            <div class="form-group">
                <label for="edit_ubicacion" class="form-label">Ubicación</label>
                <input type="text" class="glass-input" id="edit_ubicacion" name="ubicacion" required>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="button" onclick="closeModal('editBookModal')" class="glass-btn glass-btn-outline" style="flex: 1;">
                    Cancelar
                </button>
                <button type="submit" class="glass-btn ripple" style="flex: 1;">
                    <i class="bi bi-check-circle"></i>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar Libro -->
<div id="deleteBookModal" class="glass-modal-overlay">
    <div class="glass-modal" style="max-width: 450px;">
        <div class="modal-header">
            <h2 class="modal-title">Eliminar Libro</h2>
            <button onclick="closeModal('deleteBookModal')" class="modal-close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div style="padding: 1rem 0;">
            <p style="color: var(--text-muted); margin-bottom: 1rem;">
                ¿Estás seguro de que deseas eliminar este libro del inventario?
            </p>
            <div style="background: rgba(245, 101, 101, 0.1); border: 1px solid rgba(245, 101, 101, 0.3); border-radius: 12px; padding: 1rem;">
                <p id="deleteBookTitle" style="font-weight: 600; color: var(--text-light); margin-bottom: 0.25rem;"></p>
                <p id="deleteBookAutor" style="font-size: 0.9rem; color: var(--text-muted);"></p>
            </div>
        </div>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="button" onclick="closeModal('deleteBookModal')" class="glass-btn glass-btn-outline" style="flex: 1;">
                    Cancelar
                </button>
                <button type="submit" class="glass-btn ripple" style="flex: 1; background: linear-gradient(135deg, rgba(245, 101, 101, 0.8) 0%, #f56565 100%); border-color: #f56565;">
                    <i class="bi bi-trash"></i>
                    Eliminar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Botón flotante para agregar -->
<button onclick="openModal('addBookModal')" class="glass-fab" data-tooltip="Agregar libro">
    <i class="bi bi-plus"></i>
</button>

<style>
    .pagination-glass {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination-glass .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
    }

    .pagination-glass .page-item .page-link {
        padding: 0.5rem 1rem;
        background: var(--glass-bg-light);
        border: 1px solid var(--glass-border);
        border-radius: 8px;
        color: var(--text-light);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination-glass .page-item .page-link:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }

    .pagination-glass .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-brown-light) 0%, var(--primary-brown) 100%);
        border-color: var(--primary-brown);
    }

    .pagination-glass .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

@push('scripts')
<script>
    function openEditModal(id, titulo, autor, año, clasificacion, ubicacion) {
        document.getElementById('editForm').action = `/inventario/${id}`;
        document.getElementById('edit_titulo').value = titulo;
        document.getElementById('edit_autor').value = autor;
        document.getElementById('edit_año').value = año;
        document.getElementById('edit_clasificacion').value = clasificacion;
        document.getElementById('edit_ubicacion').value = ubicacion;
        openModal('editBookModal');
    }

    function openDeleteModal(id, titulo, autor) {
        document.getElementById('deleteForm').action = `/inventario/${id}`;
        document.getElementById('deleteBookTitle').textContent = titulo;
        document.getElementById('deleteBookAutor').textContent = autor;
        openModal('deleteBookModal');
    }
</script>
@endpush
@endsection