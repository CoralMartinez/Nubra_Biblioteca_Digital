<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Biblioteca Digital</title>
  <style>
    body{font-family:Arial;margin:20px;background:#f5f5f5;}
    h1{margin-bottom:10px;}
    .libros{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:15px;}
    .card{background:white;padding:12px;border-radius:8px;box-shadow:0 2px 4px rgba(0,0,0,.1);}
    .card h3{margin:0;font-size:1rem;}
    .autor{color:#666;font-size:.85rem;}
  </style>
</head>
<body>

<h1>Biblioteca Digital</h1>
<p>Catálogo de libros disponibles</p>

<div class="libros">
  <div class="card">
    <h3>Cien años de soledad</h3>
    <p class="autor">Gabriel García Márquez</p>
  </div>

  <div class="card">
    <h3>El Principito</h3>
    <p class="autor">Antoine de Saint-Exupéry</p>
  </div>

  <div class="card">
    <h3>Fundamentos de Bases de Datos</h3>
    <p class="autor">Elmasri & Navathe</p>
  </div>

  <div class="card">
    <h3>Introducción a los Algoritmos</h3>
    <p class="autor">Cormen, Leiserson, Rivest</p>
  </div>
</div>

</body>
</html>
