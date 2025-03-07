<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAuthenticated(); // Redirigir si no está autenticado
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Procesar el formulario de añadir reseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['user_id'];
    $producto_id = $_POST['producto_id'];
    $comentario = $_POST['comentario'];
    $puntuacion = $_POST['puntuacion'];

    // Insertar la reseña en la base de datos
    $stmt = $conn->prepare("INSERT INTO Reseñas (usuario_id, producto_id, comentario, puntuacion) VALUES (:usuario_id, :producto_id, :comentario, :puntuacion)");
    $stmt->execute([
        'usuario_id' => $usuario_id,
        'producto_id' => $producto_id,
        'comentario' => $comentario,
        'puntuacion' => $puntuacion
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
    <title>Añadir Reseña - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Añadir Reseña</h1>
        <form action="add.php" method="POST">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" required>
                <?php foreach ($productos as $producto): ?>
                    <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="comentario">Comentario:</label>
            <textarea name="comentario" required></textarea>
            
            <label for="puntuacion">Puntuación (1-5):</label>
            <input type="number" name="puntuacion" min="1" max="5" required>
            
            <button type="submit" class="btn">Añadir Reseña</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>