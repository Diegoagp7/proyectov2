<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Procesar el formulario de añadir producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $imagen = $_POST['imagen'];

    // Insertar el producto en la base de datos
    $stmt = $conn->prepare("INSERT INTO Productos (nombre, descripcion, precio, categoria, imagen) VALUES (:nombre, :descripcion, :precio, :categoria, :imagen)");
    $stmt->execute([
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'precio' => $precio,
        'categoria' => $categoria,
        'imagen' => $imagen
    ]);

    // Redirigir a la lista de productos
    header('Location: list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Añadir Producto</h1>
        <form action="add.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
            
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required></textarea>
            
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" required>
            
            <label for="categoria">Categoría:</label>
            <select name="categoria" required>
                <option value="tortas">Tortas</option>
                <option value="galletas">Galletas</option>
                <option value="quesillos">Quesillos</option>
                <option value="postres">Postres</option>
            </select>
            
            <label for="imagen">Imagen (URL):</label>
            <input type="text" name="imagen" required>
            
            <button type="submit" class="btn">Añadir Producto</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>