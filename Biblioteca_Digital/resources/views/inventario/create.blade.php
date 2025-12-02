@extends('layouts.app-glassmorphism')

@section('title', 'Nuevo Libro - Nubra Digital')

@section('content')
<div class="page-transition-enter">
    
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('inventario.index') }}" style="color: var(--text-muted); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
            <i class="bi bi-arrow-left"></i> Volver al inventario
        </a>
        <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-light);">Registrar Nuevo Libro</h1>
        <p style="color: var(--text-muted);">Los datos serán procesados por FastAPI (Python)</p>
    </div>

    <div class="glass-card" style="max-width: 800px; margin: 0 auto;">
        <form id="createLibroForm">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Título del Libro</label>
                    <input type="text" id="titulo" class="glass-input" required placeholder="Ej. El Principito" style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                </div>
                
                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Autor</label>
                    <input type="text" id="autor" class="glass-input" required placeholder="Ej. Antoine de Saint-Exupéry" style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="form-group">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Año de Publicación</label>
                    <input type="number" id="año" class="glass-input" required min="1000" max="{{ date('Y') + 1 }}" placeholder="2023" style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
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
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">Ubicación Física</label>
                    <input type="text" id="ubicacion" class="glass-input" required placeholder="Ej. Estante A-3" style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: white;">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('inventario.index') }}" class="glass-btn glass-btn-outline" style="text-decoration: none;">Cancelar</a>
                <button type="submit" class="glass-btn" id="btnGuardar">
                    <span id="btnText">Guardar Libro</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const API_URL = 'http://127.0.0.1:8001/libros';

    document.getElementById('createLibroForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // UI Loading
        const btn = document.getElementById('btnGuardar');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        
        btn.disabled = true;
        btnText.style.display = 'none';
        btnSpinner.style.display = 'inline-block';

        // Recolectar datos
        const data = {
            titulo: document.getElementById('titulo').value,
            autor: document.getElementById('autor').value,
            año: parseInt(document.getElementById('año').value),
            clasificacion: document.getElementById('clasificacion').value,
            ubicacion: document.getElementById('ubicacion').value
        };

        try {
            const response = await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(JSON.stringify(errorData));
            }

            // Éxito
            alert('¡Libro registrado exitosamente en FastAPI!');
            window.location.href = "{{ route('inventario.index') }}";

        } catch (error) {
            console.error('Error:', error);
            alert('Error al guardar: Asegúrate de que FastAPI esté corriendo (Puerto 8001).');
            
            // Restaurar UI
            btn.disabled = false;
            btnText.style.display = 'inline';
            btnSpinner.style.display = 'none';
        }
    });
</script>
@endsection