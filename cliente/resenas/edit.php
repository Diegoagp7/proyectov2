<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAuthenticated(); // Redirigir si no está autenticado
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID de la reseña a editar
$id = $_GET['id'];

// Obtener los datos de la reseña
$stmt = $conn->prepare("SELECT * FROM Reseñas WHERE id = :id");
$stmt->execute(['id' => $id]);
$reseña = $stmt->fetch(PDO::FETCH_ASSOC);

// Procesar el formulario de editar reseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $puntuacion = $_POST['puntuacion'];

    // Actualizar la reseña en la base de datos
    $stmt = $conn->prepare("UPDATE Reseñas SET comentario = :comentario, puntuacion = :puntuacion WHERE id = :id");
    $stmt->execute([
        'comentario' => $comentario,
        'puntuacion' => $puntuacion,
        'id' => $id
    ]);

    // Redirigir a la lista de reseñas
    header('Location: list.php');
    exit();
}

// Obtener los productos para el formulario
$stmt = $conn->query("SELECT * FROM Productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reseña - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Editar Reseña</h1>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" required>
                <?php foreach ($productos as $producto): ?>
                    <option value="<?php echo $producto['id']; ?>" <?php echo ($producto['id'] === $reseña['producto_id']) ? 'selected' : ''; ?>><?php echo $producto['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="comentario">Comentario:</label>
            <textarea name="comentario" required><?php echo $reseña['comentario']; ?></textarea>
            
            <label for="puntuacion">Puntuación (1-5):</label>
            <input type="number" name="puntuacion" min="1" max="5" value="<?php echo $reseña['puntuacion']; ?>" required>
            
            <button type="submit" class="btn">Guardar Cambios</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>