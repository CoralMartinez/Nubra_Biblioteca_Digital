<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio de Libros</title>

    <!-- CDN de TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-indigo-600">
             Repositorio de Libros
        </h1>

        <!-- Buscador -->
        <div class="flex justify-center mb-8">
            <form action="#" method="GET" class="w-full max-w-md">
                <div class="flex border rounded-lg overflow-hidden shadow-sm">
                    <input type="text" 
                           name="query" 
                           class="flex-grow p-2 outline-none" 
                           placeholder="Buscar libro o autor..." 
                           required>
                    <button type="submit" 
                            class="bg-indigo-600 text-white px-4 hover:bg-indigo-700 transition">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de libros -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 flex flex-col">
                <img src="https://cdn-icons-png.flaticon.com/512/29/29302.png" 
                     alt="Portada del libro"
                     class="rounded-lg mb-3 h-48 w-full object-cover">
                <h2 class="font-semibold text-lg text-gray-800">Cien años de soledad</h2>
                <p class="text-gray-600 text-sm mb-2">Autor: Gabriel García Márquez</p>
                <p class="text-gray-500 text-sm mb-3">Una de las obras más importantes de la literatura hispanoamericana.</p>
                <a href="#" 
                   class="mt-auto inline-block text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Ver detalles
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 flex flex-col">
                <img src="https://cdn-icons-png.flaticon.com/512/29/29302.png" 
                     alt="Portada del libro"
                     class="rounded-lg mb-3 h-48 w-full object-cover">
                <h2 class="font-semibold text-lg text-gray-800">El Principito</h2>
                <p class="text-gray-600 text-sm mb-2">Autor: Antoine de Saint-Exupéry</p>
                <p class="text-gray-500 text-sm mb-3">Un clásico sobre la amistad, la imaginación y la infancia.</p>
                <a href="#" 
                   class="mt-auto inline-block text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Ver detalles
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 flex flex-col">
                <img src="https://cdn-icons-png.flaticon.com/512/29/29302.png" 
                     alt="Portada del libro"
                     class="rounded-lg mb-3 h-48 w-full object-cover">
                <h2 class="font-semibold text-lg text-gray-800">Don Quijote de la Mancha</h2>
                <p class="text-gray-600 text-sm mb-2">Autor: Miguel de Cervantes</p>
                <p class="text-gray-500 text-sm mb-3">Una novela emblemática de la literatura española.</p>
                <a href="#" 
                   class="mt-auto inline-block text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Ver detalles
                </a>
            </div>

        </div>

        <!-- Sin resultados -->
        <p class="text-center text-gray-500 mt-8">No se encontraron más libros.</p>
    </div>

</body>
</html>
