<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRUD Libros</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 p-6">
  <h1 class="text-2xl font-bold mb-4">Libros</h1>

  <!-- Crear libro -->
  <form action="{{ url_for('books_create') }}" method="post" class="mb-6 flex gap-2">
    <input name="title" placeholder="Título" class="px-2 py-1 rounded bg-slate-800">
    <input name="author" placeholder="Autor" class="px-2 py-1 rounded bg-slate-800">
    <button class="px-3 py-1 bg-indigo-600 rounded">Agregar</button>
  </form>

  <!-- Lista de libros -->
  <table class="w-full text-left border border-slate-700">
    <thead class="bg-slate-800">
      <tr>
        <th class="px-2 py-1">Título</th>
        <th class="px-2 py-1">Autor</th>
        <th class="px-2 py-1">Acciones</th>
      </tr>
    </thead>
    <tbody>
      {% for book in books %}
      <tr class="border-t border-slate-700">
        <td class="px-2 py-1">{{ book.title }}</td>
        <td class="px-2 py-1">{{ book.author }}</td>
        <td class="px-2 py-1 flex gap-2">
          <a href="{{ url_for('books_update', book_id=book.id) }}" class="px-2 py-1 bg-indigo-600 rounded">Editar</a>
          <form action="{{ url_for('books_delete', book_id=book.id) }}" method="post">
            <button class="px-2 py-1 bg-red-600 rounded">Eliminar</button>
          </form>
        </td>
      </tr>
      {% else %}
      <tr><td colspan="3" class="px-2 py-2 text-center text-slate-400">No hay libros</td></tr>
      {% endfor %}
    </tbody>
  </table>
</body>
</html>