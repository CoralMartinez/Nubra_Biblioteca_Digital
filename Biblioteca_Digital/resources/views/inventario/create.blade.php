@extends('layouts.app-glassmorphism')

@section('title', 'Agregar Libro')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Agregar Nuevo Libro</h1>
        <p class="text-muted mb-0">Completa la información del libro físico</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('inventario.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input 
                                type="text" 
                                class="form-control @error('titulo') is-invalid @enderror" 
                                id="titulo" 
                                name="titulo" 
                                value="{{ old('titulo') }}"
                                required
                            >
                            @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <input 
                                type="text" 
                                class="form-control @error('autor') is-invalid @enderror" 
                                id="autor" 
                                name="autor" 
                                value="{{ old('autor') }}"
                                required
                            >
                            @error('autor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="año" class="form-label">Año</label>
                            <input 
                                type="number" 
                                class="form-control @error('año') is-invalid @enderror" 
                                id="año" 
                                name="año" 
                                value="{{ old('año', date('Y')) }}"
                                min="1000"
                                max="{{ date('Y') + 1 }}"
                                required
                            >
                            @error('año')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="clasificacion" class="form-label">Clasificación</label>
                            <input 
                                type="text" 
                                class="form-control @error('clasificacion') is-invalid @enderror" 
                                id="clasificacion" 
                                name="clasificacion" 
                                value="{{ old('clasificacion') }}"
                                placeholder="ej: 863.64"
                                required
                            >
                            @error('clasificacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input 
                                type="text" 
                                class="form-control @error('ubicacion') is-invalid @enderror" 
                                id="ubicacion" 
                                name="ubicacion" 
                                value="{{ old('ubicacion') }}"
                                placeholder="ej: Estante A-12"
                                required
                            >
                            @error('ubicacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Agregar Libro
                            </button>
                            <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection