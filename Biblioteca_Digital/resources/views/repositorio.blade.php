@extends('layouts.app-glassmorphism')

@section('title', 'Repositorio Digital - Nubra Digital')

@section('content')
<div class="repository-container">
    
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-light);">
                Repositorio Digital
            </h1>
            <p style="color: var(--text-muted); font-size: 1.1rem;">
                Explora nuestra colección de libros digitales y recursos
            </p>
        </div>
        
        @if(Auth::check() && Auth::user()->rol === 'admin')
        <a href="#" class="glass-btn ripple" style="text-decoration: none;">
            <i class="bi bi-cloud-arrow-up"></i>
            <span>Subir Libro</span>
        </a>
        @endif
    </div>

    <!-- Stats Grid (Dinámico) -->
    <div class="stats-grid" style="margin-bottom: 2rem;">
        <div class="glass-card card-animate" style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem;">
            <div class="stat-icon" style="font-size: 2rem; color: var(--primary-brown);">
                <i class="bi bi-book"></i>
            </div>
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-light); margin: 0;">
                    {{ number_format($stats['total_libros']) }}
                </h3>
                <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Libros Digitales</p>
            </div>
        </div>
        <div class="glass-card card-animate" style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem;">
            <div class="stat-icon" style="font-size: 2rem; color: var(--primary-brown);">
                <i class="bi bi-download"></i>
            </div>
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-light); margin: 0;">
                    {{ number_format($stats['descargas']) }}
                </h3>
                <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Descargas Totales</p>
            </div>
        </div>
        <div class="glass-card card-animate" style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem;">
            <div class="stat-icon" style="font-size: 2rem; color: var(--primary-brown);">
                <i class="bi bi-eye"></i>
            </div>
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-light); margin: 0;">
                    {{ number_format($stats['vistas']) }}
                </h3>
                <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Visualizaciones</p>
            </div>
        </div>
    </div>

    <!-- Filtros y Búsqueda (Formulario Real GET) -->
    <div class="glass-card" style="padding: 1.5rem; margin-bottom: 3rem;">
        <form action="{{ route('repositorio.index') }}" method="GET">
            <div style="margin-bottom: 1.5rem; position: relative;">
                <i class="bi bi-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="glass-input" placeholder="Buscar por título o autor..." style="padding-left: 3rem; width: 100%;">
            </div>

            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <select name="genero" class="glass-input" style="flex: 1; min-width: 150px; background-color: rgba(0,0,0,0.3);">
                    <option value="">Todos los géneros</option>
                    <option value="ficcion" {{ request('genero') == 'ficcion' ? 'selected' : '' }}>Ficción</option>
                    <option value="ciencia" {{ request('genero') == 'ciencia' ? 'selected' : '' }}>Ciencia</option>
                    <option value="historia" {{ request('genero') == 'historia' ? 'selected' : '' }}>Historia</option>
                    <option value="infantil" {{ request('genero') == 'infantil' ? 'selected' : '' }}>Infantil</option>
                    <option value="clasico" {{ request('genero') == 'clasico' ? 'selected' : '' }}>Clásico</option>
                </select>

                <select name="idioma" class="glass-input" style="flex: 1; min-width: 150px; background-color: rgba(0,0,0,0.3);">
                    <option value="">Todos los idiomas</option>
                    <option value="español" {{ request('idioma') == 'español' ? 'selected' : '' }}>Español</option>
                    <option value="ingles" {{ request('idioma') == 'ingles' ? 'selected' : '' }}>Inglés</option>
                </select>

                <select name="orden" class="glass-input" style="flex: 1; min-width: 150px; background-color: rgba(0,0,0,0.3);">
                    <option value="recientes" {{ request('orden') == 'recientes' ? 'selected' : '' }}>Más recientes</option>
                    <option value="populares" {{ request('orden') == 'populares' ? 'selected' : '' }}>Más populares</option>
                    <option value="descargados" {{ request('orden') == 'descargados' ? 'selected' : '' }}>Más descargados</option>
                    <option value="az" {{ request('orden') == 'az' ? 'selected' : '' }}>A-Z</option>
                </select>

                <button type="submit" class="glass-btn glass-btn-outline">
                    <i class="bi bi-funnel"></i> Filtrar
                </button>
                
                @if(request()->anyFilled(['search', 'genero', 'idioma', 'orden']))
                <a href="{{ route('repositorio.index') }}" class="glass-btn glass-btn-outline" style="border-color: #f56565; color: #f56565;">
                    <i class="bi bi-x-lg"></i> Limpiar
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Grid de Resultados -->
    @if($libros->count() > 0)
    <div class="books-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        
        @foreach($libros as $libro)
        <div class="glass-card card-animate book-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
            @if($libro->destacado)
            <div style="position: absolute; top: 10px; right: 10px; background: rgba(241, 196, 15, 0.9); color: #000; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; z-index: 2;">
                Destacado
            </div>
            @endif
            
            <!-- Portada (Placeholder dinámico o imagen real si existiera) -->
            <div style="height: 250px; background: linear-gradient(135deg, var(--primary-brown) 0%, #5d4a30 100%); display: flex; align-items: center; justify-content: center; position: relative;">
                @if($libro->ruta_portada)
                    <img src="{{ asset('storage/' . $libro->ruta_portada) }}" alt="{{ $libro->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i class="bi bi-book-half" style="font-size: 4rem; color: rgba(255,255,255,0.5);"></i>
                    <div style="position: absolute; bottom: 1rem; left: 1rem; right: 1rem; text-align: center; color: rgba(255,255,255,0.8); font-size: 0.8rem; font-weight: bold;">
                        {{ $libro->genero ? strtoupper($libro->genero) : 'LIBRO' }}
                    </div>
                @endif
            </div>

            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="book-title" style="font-size: 1.1rem; font-weight: 600; color: var(--text-light); margin-bottom: 0.5rem; line-height: 1.3;">
                    {{ $libro->titulo }}
                </h3>
                <p class="book-author" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                    {{ $libro->autor }}
                </p>
                
                <div class="book-meta" style="display: flex; gap: 0.5rem; margin-bottom: 1rem; flex-wrap: wrap;">
                    <span class="glass-badge" style="font-size: 0.75rem;">{{ ucfirst($libro->genero) }}</span>
                    <span class="glass-badge" style="font-size: 0.75rem;">{{ ucfirst($libro->idioma) }}</span>
                </div>

                <div class="book-stats" style="display: flex; justify-content: space-between; color: var(--text-muted); font-size: 0.8rem; margin-bottom: 1.5rem;">
                    <span title="Visualizaciones"><i class="bi bi-eye"></i> {{ number_format($libro->vistas) }}</span>
                    <span title="Descargas"><i class="bi bi-download"></i> {{ number_format($libro->descargas) }}</span>
                </div>

                <div style="margin-top: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <a href="#" class="glass-btn glass-btn-outline glass-btn-sm" style="justify-content: center;">Ver</a>
                    <!-- Botón de descarga real (simulada por ahora en controller) -->
                    {{-- <form action="{{ route('repositorio.download', $libro->id) }}" method="POST" style="width: 100%;"> --}}
                        {{-- @csrf --}}
                        <button class="glass-btn glass-btn-sm" style="width: 100%; justify-content: center;" onclick="alert('Funcionalidad de descarga en desarrollo')">
                            Descargar
                        </button>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Paginación -->
    <div style="padding: 1rem; display: flex; justify-content: center;">
        {{ $libros->links() }} 
    </div>

    @else
    <!-- Estado vacío -->
    <div class="glass-card" style="text-align: center; padding: 4rem 2rem;">
        <i class="bi bi-search" style="font-size: 3rem; color: var(--text-muted); opacity: 0.5;"></i>
        <h3 style="margin-top: 1.5rem; color: var(--text-light);">No se encontraron libros</h3>
        <p style="color: var(--text-muted);">Intenta ajustar tus filtros de búsqueda.</p>
        <a href="{{ route('repositorio.index') }}" class="glass-btn glass-btn-outline" style="margin-top: 1.5rem;">
            Ver todos
        </a>
    </div>
    @endif

</div>

<style>
    /* Estilos de paginación glassmorphism (reutilizados del dashboard) */
    nav[role="navigation"] { display: flex; justify-content: space-between; align-items: center; }
    nav[role="navigation"] p { margin-bottom: 0; color: var(--text-muted); font-size: 0.9rem; }
    nav[role="navigation"] a, nav[role="navigation"] span[aria-current="page"] span {
        background: transparent !important; border: 1px solid var(--glass-border) !important; color: var(--text-light) !important;
        padding: 0.5rem 0.75rem; border-radius: 8px; margin: 0 2px; text-decoration: none; transition: all 0.3s ease;
    }
    nav[role="navigation"] span[aria-current="page"] span { background: var(--primary-brown) !important; border-color: var(--primary-brown) !important; color: white !important; }
    nav[role="navigation"] a:hover { background: rgba(255,255,255,0.1) !important; }
    nav[role="navigation"] svg { width: 20px; height: 20px; fill: currentColor; }
</style>
@endsection