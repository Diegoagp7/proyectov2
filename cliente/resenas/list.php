<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAuthenticated(); // Redirigir si no está autenticado
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener las reseñas del cliente
$usuario_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM Reseñas WHERE usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $usuario_id]);
$reseñas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reseñas - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Mis Reseñas</h1>
        <a href="add.php" class="btn">Añadir Reseña</a>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Comentario</th>
                    <th>Puntuación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reseñas as $reseña): ?>
                    <tr>
                        <td><?php echo $reseña['producto_id']; ?></td>
                        <td><?php echo $reseña['comentario']; ?></td>
                        <td><?php echo $reseña['puntuacion']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $reseña['id']; ?>" class="btn">Editar</a>
                            <a href="delete.php?id=<?php echo $reseña['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../../templates/footer.php'; ?>
    <?php include '../../templates/whatsapp.php'; ?> <!-- Icono de WhatsApp -->
</body>
</html>