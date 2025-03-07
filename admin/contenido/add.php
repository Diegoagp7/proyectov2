<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Procesar el formulario de añadir contenido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    // Insertar el contenido en la base de datos
    $stmt = $conn->prepare("INSERT INTO ContenidoExclusivo (titulo, descripcion, imagen) VALUES (:titulo, :descripcion, :imagen)");
    $stmt->execute([
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'imagen' => $imagen
    ]);

    // Redirigir a la lista de contenido
    header('Location: list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Contenido Exclusivo - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Añadir Contenido Exclusivo</h1>
        <form action="add.php" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>
            
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required></textarea>
            
            <label for="imagen">Imagen (URL):</label>
            <input type="text" name="imagen" required>
            
            <button type="submit" class="btn">Añadir Contenido</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>