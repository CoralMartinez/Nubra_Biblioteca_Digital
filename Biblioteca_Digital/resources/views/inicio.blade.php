@extends('layouts.app-glassmorphism')

@section('content')
<div class="min-vh-100 bg-light">
    <!-- Hero Section -->
    <section class="text-center py-5 mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Bienvenido a la Biblioteca Digital</h1>
            <p class="lead text-muted mx-auto" style="max-width: 800px;">
                Explora nuestra colección de libros digitales y gestiona el inventario de recursos físicos
            </p>
        </div>
    </section>

    <!-- Quick Access Cards -->
    <section class="container mb-5">
        <div class="row g-4">
            <!-- Repositorio Digital Card -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-collection fs-3 text-primary"></i>
                        </div>
                        <h5 class="card-title fw-bold">Repositorio Digital</h5>
                        <p class="card-text text-muted mb-4">
                            Accede a nuestra colección de libros digitales disponibles para lectura y descarga
                        </p>
                        
                    </div>
                </div>
            </div>

            <!-- Inventario Físico Card -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-book fs-3 text-success"></i>
                        </div>
                        <h5 class="card-title fw-bold">Inventario Físico</h5>
                        <p class="card-text text-muted mb-4">
                            Gestiona el catálogo de libros físicos disponibles en la biblioteca
                        </p>
                        
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="container mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title h4 fw-bold mb-4">Acerca de Nuestra Biblioteca</h2>
                <p class="text-muted mb-3" style="line-height: 1.8;">
                    Nuestra biblioteca digital es un espacio dedicado a fomentar el amor por la lectura y el conocimiento.
                    Ofrecemos acceso a una amplia colección de obras literarias, académicas y de referencia.
                </p>
                <p class="text-muted mb-0" style="line-height: 1.8;">
                    La lectura es fundamental para el desarrollo personal y profesional. A través de los libros, expandimos
                    nuestra comprensión del mundo, desarrollamos pensamiento crítico y enriquecemos nuestra imaginación.
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container pb-5">
        <h2 class="h4 fw-bold mb-4">Estadísticas</h2>
        <div class="row g-4">
            <!-- Libros Digitales -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="card-subtitle text-muted mb-0">Libros Digitales</h6>
                            <i class="bi bi-collection text-muted"></i>
                        </div>
                        <h3 class="fw-bold mb-1">1,234</h3>
                        <p class="text-muted small mb-0">Disponibles para lectura</p>
                    </div>
                </div>
            </div>

            <!-- Usuarios Activos -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="card-subtitle text-muted mb-0">Usuarios Activos</h6>
                            <i class="bi bi-people text-muted"></i>
                        </div>
                        <h3 class="fw-bold mb-1">573</h3>
                        <p class="text-muted small mb-0">Este mes</p>
                    </div>
                </div>
            </div>

            <!-- Lecturas Completadas -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="card-subtitle text-muted mb-0">Lecturas Completadas</h6>
                            <i class="bi bi-graph-up text-muted"></i>
                        </div>
                        <h3 class="fw-bold mb-1">2,847</h3>
                        <p class="text-muted small mb-0">+12% respecto al mes anterior</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>
@endsection