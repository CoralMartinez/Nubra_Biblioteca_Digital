@extends('layouts.app-glassmorphism')

@section('title', 'Inventario - Nubra Digital')

@section('content')
<div class="page-transition-enter">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-light);">Inventario Físico</h1>
            <p style="color: var(--text-muted);">Gestionado vía FastAPI (Python)</p>
        </div>
        <a href="{{ route('inventario.create') }}" class="glass-btn">
            <i class="bi bi-plus-lg"></i> Nuevo Libro
        </a>
    </div>

    <div class="glass-card" style="padding: 0;">
        <div class="glass-table-container">
            <table class="glass-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Año</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-libros">
                    <!-- Aquí JS inyectará los datos -->
                </tbody>
            </table>
            
            <!-- Loading Spinner (Se muestra al inicio) -->
            <div id="loading" style="text-align: center; padding: 2rem;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p style="margin-top: 1rem; color: var(--text-muted);">Conectando con FastAPI...</p>
            </div>
        </div>
    </div>
</div>

<script>
    // URL de tu API en Python
    const API_URL = 'http://127.0.0.1:8001/libros';

    document.addEventListener('DOMContentLoaded', () => {
        cargarLibros();
    });

    async function cargarLibros() {
        try {
            const response = await fetch(API_URL);
            
            if (!response.ok) {
                throw new Error('Error al conectar con la API');
            }

            const libros = await response.json();
            renderizarTabla(libros);

        } catch (error) {
            console.error(error);
            document.getElementById('loading').innerHTML = `
                <p style="color: #f56565;">Error: No se pudo conectar con el servidor de Python.</p>
                <small>Asegúrate de que uvicorn esté corriendo en el puerto 8001</small>
            `;
        }
    }

    function renderizarTabla(libros) {
        const tbody = document.getElementById('tabla-libros');
        const loading = document.getElementById('loading');
        
        // Ocultar loading
        loading.style.display = 'none';
        tbody.innerHTML = '';

        if (libros.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">No hay libros registrados</td></tr>';
            return;
        }

        libros.forEach(libro => {
            // AQUÍ ESTÁ LA FUSIÓN CORRECTA: Datos + Botones en una sola variable
            const row = `
                <tr>
                    <td>#${libro.id}</td>
                    <td style="font-weight: 600; color: var(--text-light);">${libro.titulo}</td>
                    <td>${libro.autor}</td>
                    <td><span class="glass-badge">${libro.año}</span></td>
                    <td>${libro.ubicacion}</td>
                    <td>
                        <div class="table-actions">
                            <!-- Botón Editar: Es un enlace <a> que lleva a la vista de edición de Laravel -->
                            <a href="/inventario/${libro.id}/edit" class="table-btn" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <!-- Botón Eliminar: Ejecuta la función JS para borrar vía API -->
                            <button onclick="eliminarLibro(${libro.id})" class="table-btn" style="color: #f56565;" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    async function eliminarLibro(id) {
        if (!confirm('¿Estás seguro de eliminar este libro vía API?')) return;

        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE'
            });

            if (response.ok) {
                alert('Libro eliminado correctamente');
                cargarLibros(); // Recargar la tabla sin refrescar la página
            } else {
                alert('Error al eliminar');
            }
        } catch (error) {
            console.error(error);
            alert('Error de conexión');
        }
    }
</script>
@endsection