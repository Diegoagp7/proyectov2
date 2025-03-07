<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID del contenido a editar
$id = $_GET['id'];

// Obtener los datos del contenido
$stmt = $conn->prepare("SELECT * FROM ContenidoExclusivo WHERE id = :id");
$stmt->execute(['id' => $id]);
$contenido = $stmt->fetch(PDO::FETCH_ASSOC);

// Procesar el formulario de editar contenido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    // Actualizar el contenido en la base de datos
    $stmt = $conn->prepare("UPDATE ContenidoExclusivo SET titulo = :titulo, descripcion = :descripcion, imagen = :imagen WHERE id = :id");
    $stmt->execute([
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'imagen' => $imagen,
        'id' => $id
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
    <title>Editar Contenido Exclusivo - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Editar Contenido Exclusivo</h1>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php echo $contenido['titulo']; ?>" required>
            
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required><?php echo $contenido['descripcion']; ?></textarea>
            
            <label for="imagen">Imagen (URL):</label>
            <input type="text" name="imagen" value="<?php echo $contenido['imagen']; ?>" required>
            
            <button type="submit" class="btn">Guardar Cambios</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>