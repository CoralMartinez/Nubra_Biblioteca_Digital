@extends('layouts.app-glassmorphism')

@section('title', 'Inicio - Nubra Digital')

@section('content')
<div class="home-container">
    <!-- Hero Section -->
    <section class="hero-section" style="margin-bottom: 4rem;">
        <h1 class="hero-title">
            Bienvenido a Nubra Digital
        </h1>
        <p class="hero-subtitle">
            Explora nuestra colección de libros digitales y gestiona el inventario de recursos físicos
        </p>
    </section>

    <!-- Quick Access Cards -->
    <section class="quick-access" style="margin-bottom: 4rem;">
        <div class="cards-grid">
            <!-- Card Repositorio -->
            <a href="{{ route('repositorio.index') }}" class="glass-card card-animate" style="text-decoration: none; color: inherit;">
                <div class="card-icon">
                    <i class="bi bi-collection"></i>
                </div>
                <h3 class="card-title">Repositorio Digital</h3>
                <p class="card-description">
                    Accede a nuestra colección de libros digitales disponibles para lectura y descarga
                </p>
                <div class="card-action">
                    <span style="color: var(--primary-brown); font-weight: 600;">Explorar Repositorio</span>
                    <i class="bi bi-arrow-right" style="color: var(--primary-brown);"></i>
                </div>
            </a>

            <!-- Card Inventario -->
            <a href="{{ route('inventario.index') }}" class="glass-card card-animate" style="text-decoration: none; color: inherit;">
                <div class="card-icon">
                    <i class="bi bi-book"></i>
                </div>
                <h3 class="card-title">Inventario Físico</h3>
                <p class="card-description">
                    Gestiona el catálogo de libros físicos disponibles en la biblioteca
                </p>
                <div class="card-action">
                    <span style="color: var(--primary-brown); font-weight: 600;">Ver Inventario</span>
                    <i class="bi bi-arrow-right" style="color: var(--primary-brown);"></i>
                </div>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" style="margin-bottom: 4rem;">
        <div class="glass-card card-animate">
            <h2 class="card-title" style="font-size: 2rem; margin-bottom: 1.5rem;">
                Acerca de Nuestra Biblioteca
            </h2>
            <div style="display: grid; gap: 1rem; color: var(--text-muted); line-height: 1.8;">
                <p>
                    Nuestra biblioteca digital es un espacio dedicado a fomentar el amor por la lectura y el conocimiento.
                    Ofrecemos acceso a una amplia colección de obras literarias, académicas y de referencia.
                </p>
                <p>
                    La lectura es fundamental para el desarrollo personal y profesional. A través de los libros, expandimos
                    nuestra comprensión del mundo, desarrollamos pensamiento crítico y enriquecemos nuestra imaginación.
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 2rem; color: var(--text-light);">
            Estadísticas
        </h2>
        <div class="stats-grid">
            <!-- Stat 1 -->
            <div class="glass-card card-animate">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <h3 style="font-size: 0.9rem; font-weight: 500; color: var(--text-muted);">
                        Libros Digitales
                    </h3>
                    <i class="bi bi-collection" style="color: var(--text-muted); font-size: 1.2rem;"></i>
                </div>
                <div class="stat-number" data-target="1234">0</div>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem;">
                    Disponibles para lectura
                </p>
            </div>

            <!-- Stat 2 -->
            <div class="glass-card card-animate">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <h3 style="font-size: 0.9rem; font-weight: 500; color: var(--text-muted);">
                        Usuarios Activos
                    </h3>
                    <i class="bi bi-people" style="color: var(--text-muted); font-size: 1.2rem;"></i>
                </div>
                <div class="stat-number" data-target="573">0</div>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem;">
                    Este mes
                </p>
            </div>

            <!-- Stat 3 -->
            <div class="glass-card card-animate">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <h3 style="font-size: 0.9rem; font-weight: 500; color: var(--text-muted);">
                        Lecturas Completadas
                    </h3>
                    <i class="bi bi-graph-up" style="color: var(--text-muted); font-size: 1.2rem;"></i>
                </div>
                <div class="stat-number" data-target="2847">0</div>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem;">
                    +12% respecto al mes anterior
                </p>
            </div>
        </div>
    </section>
</div>

<style>
    .hero-section {
        text-align: center;
        padding: 2rem 0;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #ffffff 0%, var(--primary-brown) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: var(--text-muted);
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
    }

    .card-action {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .glass-card:hover .card-action {
        gap: 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--text-light);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@push('scripts')
<script>
    // Animación de contador para estadísticas
    document.addEventListener('DOMContentLoaded', function() {
        const statNumbers = document.querySelectorAll('.stat-number');
        
        const animateCounter = (element) => {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 segundos
            const increment = target / (duration / 16); // 60 FPS
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    element.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target.toLocaleString();
                }
            };
            
            updateCounter();
        };
        
        // Intersection Observer para animar cuando sea visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        statNumbers.forEach(stat => observer.observe(stat));
    });
</script>
@endpush
@endsection