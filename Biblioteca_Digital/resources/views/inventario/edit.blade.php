@extends('layouts.app-glassmorphism')

@section('title', 'Editar Libro - Nubra Digital')

@section('content')
<div class="page-transition-enter">
    
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('inventario.index') }}" style="color: var(--text-muted); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
            <i class="bi bi-arrow-left"></i> Volver al inventario
        </a>
        <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-light);">Editar Libro #{{ $libro->id }}</h1>
        <p style="color: var(--text-muted);">Editando información vía FastAPI (PUT)</p>
    </div>

    <!-- Loader inicial -->
    <div id="loadingData" style="text-align: center; padding: 4rem;">
        <div class="spinner-border text-primary" role="status"></div>
        <p style="margin-top: 1rem; color: var(--text-muted);">Recuperando datos del libro...</p>
    </div>

    <!-- Formulario (Oculto al inicio) -->
    <div id="formContainer" class="glass-card" style="max-width: 800px; margin: 0 auto; display: none;">
        <form id="editLibroForm">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Título del Libro</label>
                    <input type="text" id="titulo" class="glass-input" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                </div>
                
                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Autor</label>
                    <input type="text" id="autor" class="glass-input" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Año</label>
                    <input type="number" id="año" class="glass-input" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                </div>

                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Clasificación</label>
                    <select id="clasificacion" class="glass-input" style="width: 100%; padding: 0.8rem; background: rgba(0,0,0,0.3); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                        <option value="Novela" style="color: black;">Novela</option>
                        <option value="Ciencia" style="color: black;">Ciencia</option>
                        <option value="Historia" style="color: black;">Historia</option>
                        <option value="Infantil" style="color: black;">Infantil</option>
                        <option value="Biografía" style="color: black;">Biografía</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Ubicación</label>
                    <input type="text" id="ubicacion" class="glass-input" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('inventario.index') }}" class="glass-btn glass-btn-outline" style="text-decoration: none;">Cancelar</a>
                <button type="submit" class="glass-btn" id="btnGuardar">
                    <span id="btnText">Actualizar Libro</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // ID del libro inyectado desde el controlador de Laravel
    const LIBRO_ID = "{{ $libro->id }}"; 
    const API_URL = `http://127.0.0.1:8001/libros/${LIBRO_ID}`;

    // 1. Cargar datos al iniciar
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            const response = await fetch(API_URL);
            if (!response.ok) throw new Error('Error al cargar');
            
            const libro = await response.json();
            
            // Llenar campos
            document.getElementById('titulo').value = libro.titulo;
            document.getElementById('autor').value = libro.autor;
            document.getElementById('año').value = libro.año;
            document.getElementById('clasificacion').value = libro.clasificacion;
            document.getElementById('ubicacion').value = libro.ubicacion;

            // Mostrar formulario
            document.getElementById('loadingData').style.display = 'none';
            document.getElementById('formContainer').style.display = 'block';

        } catch (error) {
            console.error(error);
            alert('No se pudo cargar la información del libro desde FastAPI');
            window.location.href = "{{ route('inventario.index') }}";
        }
    });

    // 2. Manejar actualización (PUT)
    document.getElementById('editLibroForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('btnGuardar');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        
        btn.disabled = true;
        btnText.style.display = 'none';
        btnSpinner.style.display = 'inline-block';

        const data = {
            titulo: document.getElementById('titulo').value,
            autor: document.getElementById('autor').value,
            año: parseInt(document.getElementById('año').value),
            clasificacion: document.getElementById('clasificacion').value,
            ubicacion: document.getElementById('ubicacion').value
        };

        try {
            const response = await fetch(API_URL, {
                method: 'PUT', // <--- Método clave para editar
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) throw new Error('Error en actualización');

            alert('¡Libro actualizado correctamente!');
            window.location.href = "{{ route('inventario.index') }}";

        } catch (error) {
            console.error(error);
            alert('Error al actualizar.');
            btn.disabled = false;
            btnText.style.display = 'inline';
            btnSpinner.style.display = 'none';
        }
    });
</script>
@endsection