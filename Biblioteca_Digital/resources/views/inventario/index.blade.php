@extends('layouts.app')

@section('title', 'Inventario Físico')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Inventario Físico</h1>
            <p class="text-muted mb-0">Gestiona el catálogo de libros físicos de la biblioteca</p>
        </div>
        <a href="{{ route('inventario.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Agregar Libro
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Catálogo de Libros</h5>
            <small class="text-muted">{{ $libros->count() }} {{ $libros->count() === 1 ? 'libro registrado' : 'libros registrados' }}</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Año</th>
                            <th>Clasificación</th>
                            <th>Ubicación</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($libros as $libro)
                        <tr>
                            <td class="fw-medium">{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->año }}</td>
                            <td>{{ $libro->clasificacion }}</td>
                            <td>{{ $libro->ubicacion }}</td>
                            <td class="text-end">
                                <a href="{{ route('inventario.edit', $libro->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $libro->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Modal de eliminación -->
                                <div class="modal fade" id="deleteModal{{ $libro->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar Libro</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar este libro del inventario?</p>
                                                <p class="fw-bold mb-0">{{ $libro->titulo }}</p>
                                                <p class="text-muted small">{{ $libro->autor }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('inventario.destroy', $libro->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No hay libros registrados en el inventario
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection