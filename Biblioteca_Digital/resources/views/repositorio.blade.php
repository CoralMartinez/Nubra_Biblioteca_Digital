@extends('layouts.app-glassmorphism')

@section('title', 'Repositorio Digital - Nubra Digital')

@section('content')
<div class="repository-container">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-light);">
                Repositorio Digital
            </h1>
            <p style="color: var(--text-muted); font-size: 1.1rem;">
                Explora nuestra colección de libros digitales y recursos
            </p>
        </div>
        <a href="#" class="glass-btn ripple" style="text-decoration: none;">
            <i class="bi bi-cloud-arrow-up"></i>
            <span>Subir Libro</span>
        </a>
    </div>

    <div class="stats-grid" style="margin-bottom: 2rem;">
        <div class="glass-card card-animate" style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem;">
            <div class="stat-icon" style="font-size: 2rem; color: var(--primary-brown);">
                <i class="bi bi-book"></i>
            </div>
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-light); margin: 0;">1,234</h3>
                <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Libros Digitales</p>
            </div>
        </div>
        <div class="glass-card card-animate" style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem;">
            <div class="stat-icon" style="font-size: 2rem; color: var(--primary-brown);">
                <i class="bi bi-download"></i>
            </div>
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-light); margin: 0;">12,567</h3>
                <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Descargas</p>
            </div>
        </div>
        <div class="glass-card card-animate" style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem;">
            <div class="stat-icon" style="font-size: 2rem; color: var(--primary-brown);">
                <i class="bi bi-eye"></i>
            </div>
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-light); margin: 0;">45,890</h3>
                <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Visualizaciones</p>
            </div>
        </div>
    </div>

    <div class="glass-card" style="padding: 1.5rem; margin-bottom: 3rem;">
        <div style="margin-bottom: 1.5rem; position: relative;">
            <i class="bi bi-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="text" id="searchInput" class="glass-input" placeholder="Buscar por título, autor, género..." style="padding-left: 3rem; width: 100%;">
        </div>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <select id="generoFilter" class="glass-input" style="flex: 1; min-width: 150px;">
                <option value="">Todos los géneros</option>
                <option value="ficcion">Ficción</option>
                <option value="no-ficcion">No Ficción</option>
                <option value="ciencia">Ciencia</option>
                <option value="tecnologia">Tecnología</option>
                <option value="historia">Historia</option>
                <option value="biografia">Biografía</option>
                <option value="arte">Arte</option>
            </select>

            <select id="idiomaFilter" class="glass-input" style="flex: 1; min-width: 150px;">
                <option value="">Todos los idiomas</option>
                <option value="español">Español</option>
                <option value="ingles">Inglés</option>
                <option value="frances">Francés</option>
                <option value="aleman">Alemán</option>
            </select>

            <select id="tipoFilter" class="glass-input" style="flex: 1; min-width: 150px;">
                <option value="">Tipo de documento</option>
                <option value="libro">Libro</option>
                <option value="revista">Revista</option>
                <option value="articulo">Artículo</option>
                <option value="tesis">Tesis</option>
            </select>

            <select id="ordenFilter" class="glass-input" style="flex: 1; min-width: 150px;">
                <option value="recientes">Más recientes</option>
                <option value="populares">Más populares</option>
                <option value="descargados">Más descargados</option>
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
            </select>

            <button class="glass-btn glass-btn-outline" onclick="aplicarFiltros()">
                <i class="bi bi-funnel"></i> Aplicar
            </button>
        </div>
    </div>

    <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--text-light); display: flex; align-items: center; gap: 0.5rem;">
        <i class="bi bi-star-fill" style="color: #f1c40f;"></i> Libros Destacados
    </h2>

    <div class="books-grid" id="destacadosGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
        
        <div class="glass-card card-animate book-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
            <div style="position: absolute; top: 10px; right: 10px; background: rgba(241, 196, 15, 0.9); color: #000; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; z-index: 2;">Popular</div>
            
            <div style="height: 250px; background: linear-gradient(135deg, var(--primary-brown) 0%, #5d4a30 100%); display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-book-half" style="font-size: 4rem; color: rgba(255,255,255,0.5);"></i>
            </div>

            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="book-title" style="font-size: 1.1rem; font-weight: 600; color: var(--text-light); margin-bottom: 0.5rem;">Cien Años de Soledad</h3>
                <p class="book-author" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Gabriel García Márquez</p>
                
                <div class="book-meta" style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                    <span class="glass-badge" style="font-size: 0.75rem;">Ficción</span>
                    <span class="glass-badge" style="font-size: 0.75rem;">Español</span>
                </div>

                <div class="book-stats" style="display: flex; justify-content: space-between; color: var(--text-muted); font-size: 0.8rem; margin-bottom: 1.5rem;">
                    <span><i class="bi bi-eye"></i> 1,234</span>
                    <span><i class="bi bi-download"></i> 567</span>
                </div>

                <div style="margin-top: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <button class="glass-btn glass-btn-outline glass-btn-sm" onclick="verLibro(1)">Ver</button>
                    <button class="glass-btn glass-btn-sm" onclick="descargarLibro(1)">Descargar</button>
                </div>
            </div>
        </div>

        <div class="glass-card card-animate book-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
            <div style="position: absolute; top: 10px; right: 10px; background: rgba(46, 204, 113, 0.9); color: #fff; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; z-index: 2;">Nuevo</div>
            
            <div style="height: 250px; background: linear-gradient(135deg, var(--primary-brown) 0%, #5d4a30 100%); display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-book-half" style="font-size: 4rem; color: rgba(255,255,255,0.5);"></i>
            </div>

            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="book-title" style="font-size: 1.1rem; font-weight: 600; color: var(--text-light); margin-bottom: 0.5rem;">El Principito</h3>
                <p class="book-author" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Antoine de Saint-Exupéry</p>
                
                <div class="book-meta" style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                    <span class="glass-badge" style="font-size: 0.75rem;">Infantil</span>
                    <span class="glass-badge" style="font-size: 0.75rem;">Español</span>
                </div>

                <div class="book-stats" style="display: flex; justify-content: space-between; color: var(--text-muted); font-size: 0.8rem; margin-bottom: 1.5rem;">
                    <span><i class="bi bi-eye"></i> 892</span>
                    <span><i class="bi bi-download"></i> 445</span>
                </div>

                <div style="margin-top: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <button class="glass-btn glass-btn-outline glass-btn-sm" onclick="verLibro(2)">Ver</button>
                    <button class="glass-btn glass-btn-sm" onclick="descargarLibro(2)">Descargar</button>
                </div>
            </div>
        </div>

        <div class="glass-card card-animate book-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
            <div style="height: 250px; background: linear-gradient(135deg, var(--primary-brown) 0%, #5d4a30 100%); display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-book-half" style="font-size: 4rem; color: rgba(255,255,255,0.5);"></i>
            </div>

            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="book-title" style="font-size: 1.1rem; font-weight: 600; color: var(--text-light); margin-bottom: 0.5rem;">1984</h3>
                <p class="book-author" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">George Orwell</p>
                
                <div class="book-meta" style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                    <span class="glass-badge" style="font-size: 0.75rem;">Distopía</span>
                    <span class="glass-badge" style="font-size: 0.75rem;">Español</span>
                </div>

                <div class="book-stats" style="display: flex; justify-content: space-between; color: var(--text-muted); font-size: 0.8rem; margin-bottom: 1.5rem;">
                    <span><i class="bi bi-eye"></i> 756</span>
                    <span><i class="bi bi-download"></i> 389</span>
                </div>

                <div style="margin-top: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <button class="glass-btn glass-btn-outline glass-btn-sm" onclick="verLibro(3)">Ver</button>
                    <button class="glass-btn glass-btn-sm" onclick="descargarLibro(3)">Descargar</button>
                </div>
            </div>
        </div>

        <div class="glass-card card-animate book-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
            <div style="height: 250px; background: linear-gradient(135deg, var(--primary-brown) 0%, #5d4a30 100%); display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-book-half" style="font-size: 4rem; color: rgba(255,255,255,0.5);"></i>
            </div>

            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="book-title" style="font-size: 1.1rem; font-weight: 600; color: var(--text-light); margin-bottom: 0.5rem;">Don Quijote</h3>
                <p class="book-author" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Miguel de Cervantes</p>
                
                <div class="book-meta" style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                    <span class="glass-badge" style="font-size: 0.75rem;">Clásico</span>
                    <span class="glass-badge" style="font-size: 0.75rem;">Español</span>
                </div>

                <div class="book-stats" style="display: flex; justify-content: space-between; color: var(--text-muted); font-size: 0.8rem; margin-bottom: 1.5rem;">
                    <span><i class="bi bi-eye"></i> 2,145</span>
                    <span><i class="bi bi-download"></i> 998</span>
                </div>

                <div style="margin-top: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <button class="glass-btn glass-btn-outline glass-btn-sm" onclick="verLibro(4)">Ver</button>
                    <button class="glass-btn glass-btn-sm" onclick="descargarLibro(4)">Descargar</button>
                </div>
            </div>
        </div>

    </div>

    <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--text-light);">
        Catálogo Completo
    </h2>
    <div class="books-grid" id="catalogoGrid" style="min-height: 200px;">
        <div class="glass-card loading" style="text-align: center; padding: 3rem;">
            <div class="spinner" style="border: 4px solid rgba(139, 111, 71, 0.2); border-top: 4px solid var(--primary-brown); border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite; margin: 0 auto;"></div>
            <p style="margin-top: 1.5rem; color: var(--text-muted);">Cargando catálogo completo...</p>
        </div>
    </div>

</div>

<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

@push('scripts')
<script>
    // ---------------------------------------------------------
    // TU CÓDIGO JAVASCRIPT ORIGINAL (Sin cambios de lógica)
    // ---------------------------------------------------------

    // Búsqueda en tiempo real
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const bookCards = document.querySelectorAll('.book-card');
        
        bookCards.forEach(card => {
            const title = card.querySelector('.book-title').textContent.toLowerCase();
            const author = card.querySelector('.book-author').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || author.includes(searchTerm)) {
                card.style.display = 'flex'; // Ajustado a flex para mantener el layout de la card
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Aplicar filtros
    function aplicarFiltros() {
        const genero = document.getElementById('generoFilter').value;
        const idioma = document.getElementById('idiomaFilter').value;
        const tipo = document.getElementById('tipoFilter').value;
        const orden = document.getElementById('ordenFilter').value;

        console.log('Filtros aplicados:', { genero, idioma, tipo, orden });
        
        // Alerta adaptada visualmente (opcional, o usar alert normal)
        alert('Filtros aplicados correctamente (Simulación)');
    }

    // Ver libro
    function verLibro(id) {
        // window.location.href = `/repositorio/${id}`; // Comentado para evitar error 404 en prueba
        alert('Navegando a ver libro ID: ' + id);
    }

    // Descargar libro
    function descargarLibro(id) {
        alert(`Descargando libro con ID: ${id}`);
    }

    // Simular carga de más libros (Tu lógica original)
    setTimeout(() => {
        const loadingContainer = document.querySelector('.loading');
        if(loadingContainer) {
            loadingContainer.parentElement.innerHTML = `
                <div class="glass-card" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <i class="bi bi-check-circle" style="font-size: 3rem; color: var(--text-muted); opacity: 0.5;"></i>
                    <h3 style="margin-top: 1rem; color: var(--text-light);">¡Todos los libros cargados!</h3>
                    <p style="color: var(--text-muted);">Mostrando la colección completa disponible.</p>
                </div>
            `;
        }
    }, 2000);
</script>
@endpush

@endsection