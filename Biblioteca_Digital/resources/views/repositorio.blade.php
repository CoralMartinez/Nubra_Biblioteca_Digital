<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio Digital - Nubra Biblioteca</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e22ce 100%);
            min-height: 100vh;
            color: #fff;
        }

        /* Header */
        .header {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-bar {
            flex: 1;
            max-width: 600px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: none;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 16px;
            transition: all 0.3s;
        }

        .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-bar input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
        }

        .search-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            cursor: pointer;
        }

        .btn {
            padding: 12px 28px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        /* Filters */
        .filters {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            padding: 25px;
            margin: 30px auto;
            max-width: 1400px;
            border-radius: 15px;
        }

        .filter-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group select,
        .filter-group input {
            padding: 12px 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 14px;
            min-width: 150px;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
        }

        .filter-group option {
            background: #1e3c72;
            color: white;
        }

        /* Stats Bar */
        .stats-bar {
            max-width: 1400px;
            margin: 0 auto 30px;
            padding: 0 20px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            min-width: 200px;
        }

        .stat-icon {
            font-size: 36px;
        }

        .stat-info h3 {
            font-size: 28px;
            font-weight: 700;
        }

        .stat-info p {
            font-size: 14px;
            opacity: 0.8;
        }

        /* Books Grid */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .book-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
        }

        .book-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .book-cover {
            width: 100%;
            height: 320px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .book-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(231, 76, 60, 0.9);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .book-badge.popular {
            background: rgba(241, 196, 15, 0.9);
        }

        .book-badge.new {
            background: rgba(46, 204, 113, 0.9);
        }

        .book-info {
            padding: 20px;
        }

        .book-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .book-author {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 12px;
        }

        .book-meta {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
        }

        .book-stats {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .book-stats span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .book-actions {
            display: flex;
            gap: 8px;
        }

        .book-actions .btn {
            flex: 1;
            justify-content: center;
            padding: 10px;
            font-size: 13px;
        }

        .btn-download {
            background: rgba(46, 204, 113, 0.8);
            color: white;
        }

        .btn-download:hover {
            background: rgba(46, 204, 113, 1);
        }

        .btn-view {
            background: rgba(52, 152, 219, 0.8);
            color: white;
        }

        .btn-view:hover {
            background: rgba(52, 152, 219, 1);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        .empty-state-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .empty-state p {
            opacity: 0.7;
            font-size: 16px;
        }

        /* Loading */
        .loading {
            text-align: center;
            padding: 50px;
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top: 4px solid white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }

            .search-bar {
                max-width: 100%;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 15px;
            }

            .book-cover {
                height: 240px;
            }

            .stat-card {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="logo">
                📚 Repositorio Digital
            </div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Buscar por título, autor, género...">
                <span class="search-icon">🔍</span>
            </div>
            <a href="#" class="btn btn-primary">
                ➕ Subir Libro
            </a>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="stats-bar">
        <div class="stat-card">
            <div class="stat-icon">📖</div>
            <div class="stat-info">
                <h3>1,234</h3>
                <p>Libros Digitales</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⬇️</div>
            <div class="stat-info">
                <h3>12,567</h3>
                <p>Descargas</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👁️</div>
            <div class="stat-info">
                <h3>45,890</h3>
                <p>Visualizaciones</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters">
        <div class="filter-group">
            <select id="generoFilter">
                <option value="">Todos los géneros</option>
                <option value="ficcion">Ficción</option>
                <option value="no-ficcion">No Ficción</option>
                <option value="ciencia">Ciencia</option>
                <option value="tecnologia">Tecnología</option>
                <option value="historia">Historia</option>
                <option value="biografia">Biografía</option>
                <option value="arte">Arte</option>
            </select>

            <select id="idiomaFilter">
                <option value="">Todos los idiomas</option>
                <option value="español">Español</option>
                <option value="ingles">Inglés</option>
                <option value="frances">Francés</option>
                <option value="aleman">Alemán</option>
            </select>

            <select id="tipoFilter">
                <option value="">Tipo de documento</option>
                <option value="libro">Libro</option>
                <option value="revista">Revista</option>
                <option value="articulo">Artículo</option>
                <option value="tesis">Tesis</option>
            </select>

            <select id="ordenFilter">
                <option value="recientes">Más recientes</option>
                <option value="populares">Más populares</option>
                <option value="descargados">Más descargados</option>
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
            </select>

            <button class="btn btn-primary" onclick="aplicarFiltros()">Aplicar Filtros</button>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <!-- Libros Destacados -->
        <h2 class="section-title">🌟 Libros Destacados</h2>
        <div class="books-grid" id="destacadosGrid">
            <!-- Libro 1 -->
            <div class="book-card">
                <div class="book-badge popular">⭐ Popular</div>
                <div class="book-cover">
                    📘
                </div>
                <div class="book-info">
                    <h3 class="book-title">Cien Años de Soledad</h3>
                    <p class="book-author">Gabriel García Márquez</p>
                    <div class="book-meta">
                        <span class="badge">Ficción</span>
                        <span class="badge">Español</span>
                    </div>
                    <div class="book-stats">
                        <span>👁️ 1,234</span>
                        <span>⬇️ 567</span>
                    </div>
                    <div class="book-actions">
                        <button class="btn btn-view" onclick="verLibro(1)">Ver</button>
                        <button class="btn btn-download" onclick="descargarLibro(1)">Descargar</button>
                    </div>
                </div>
            </div>

            <!-- Libro 2 -->
            <div class="book-card">
                <div class="book-badge new">🆕 Nuevo</div>
                <div class="book-cover">
                    📗
                </div>
                <div class="book-info">
                    <h3 class="book-title">El Principito</h3>
                    <p class="book-author">Antoine de Saint-Exupéry</p>
                    <div class="book-meta">
                        <span class="badge">Infantil</span>
                        <span class="badge">Español</span>
                    </div>
                    <div class="book-stats">
                        <span>👁️ 892</span>
                        <span>⬇️ 445</span>
                    </div>
                    <div class="book-actions">
                        <button class="btn btn-view" onclick="verLibro(2)">Ver</button>
                        <button class="btn btn-download" onclick="descargarLibro(2)">Descargar</button>
                    </div>
                </div>
            </div>

            <!-- Libro 3 -->
            <div class="book-card">
                <div class="book-cover">
                    📕
                </div>
                <div class="book-info">
                    <h3 class="book-title">1984</h3>
                    <p class="book-author">George Orwell</p>
                    <div class="book-meta">
                        <span class="badge">Distopía</span>
                        <span class="badge">Español</span>
                    </div>
                    <div class="book-stats">
                        <span>👁️ 756</span>
                        <span>⬇️ 389</span>
                    </div>
                    <div class="book-actions">
                        <button class="btn btn-view" onclick="verLibro(3)">Ver</button>
                        <button class="btn btn-download" onclick="descargarLibro(3)">Descargar</button>
                    </div>
                </div>
            </div>

            <!-- Libro 4 -->
            <div class="book-card">
                <div class="book-cover">
                    📙
                </div>
                <div class="book-info">
                    <h3 class="book-title">Don Quijote de la Mancha</h3>
                    <p class="book-author">Miguel de Cervantes</p>
                    <div class="book-meta">
                        <span class="badge">Clásico</span>
                        <span class="badge">Español</span>
                    </div>
                    <div class="book-stats">
                        <span>👁️ 2,145</span>
                        <span>⬇️ 998</span>
                    </div>
                    <div class="book-actions">
                        <button class="btn btn-view" onclick="verLibro(4)">Ver</button>
                        <button class="btn btn-download" onclick="descargarLibro(4)">Descargar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Todos los Libros -->
        <h2 class="section-title">📚 Catálogo Completo</h2>
        <div class="books-grid" id="catalogoGrid">
            <!-- Aquí se cargarán más libros dinámicamente -->
            <div class="loading">
                <div class="spinner"></div>
                <p style="margin-top: 20px;">Cargando más libros...</p>
            </div>
        </div>
    </div>

    <script>
        // Búsqueda en tiempo real
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const bookCards = document.querySelectorAll('.book-card');
            
            bookCards.forEach(card => {
                const title = card.querySelector('.book-title').textContent.toLowerCase();
                const author = card.querySelector('.book-author').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || author.includes(searchTerm)) {
                    card.style.display = 'block';
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
            
            // Aquí harías una petición AJAX para filtrar los libros
            alert('Filtros aplicados correctamente');
        }

        // Ver libro
        function verLibro(id) {
            window.location.href = `/repositorio/${id}`;
        }

        // Descargar libro
        function descargarLibro(id) {
            alert(`Descargando libro con ID: ${id}`);
            // Aquí implementarías la lógica de descarga real
            // window.location.href = `/repositorio/${id}/download`;
        }

        // Simular carga de más libros
        setTimeout(() => {
            document.querySelector('.loading').innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">✅</div>
                    <h3>¡Todos los libros cargados!</h3>
                    <p>Mostrando 4 de 1,234 libros disponibles</p>
                </div>
            `;
        }, 2000);
    </script>
</body>
</html>