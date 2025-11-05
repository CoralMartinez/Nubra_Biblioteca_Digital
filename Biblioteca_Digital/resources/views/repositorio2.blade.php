@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-center mb-4">Repositorio Digital 2</h1>

    <p class="text-center text-muted mb-5">
        Aquí podrás explorar y gestionar documentos académicos, artículos y material educativo de nuestra biblioteca digital.
    </p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-book fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Libros Digitales</h5>
                    <p class="text-muted small">Accede a cientos de títulos disponibles en formato PDF.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-person-lines-fill fs-1 text-success mb-3"></i>
                    <h5 class="fw-bold">Autores Destacados</h5>
                    <p class="text-muted small">Explora biografías y obras de los autores más consultados.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-journal-text fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold">Artículos Recientes</h5>
                    <p class="text-muted small">Consulta las últimas publicaciones de investigación disponibles.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
