<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAuthenticated(); // Redirigir si no está autenticado
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener los pedidos del cliente
$usuario_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM Pedidos WHERE usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $usuario_id]);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Historial de Compras</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?php echo $pedido['id']; ?></td>
                        <td><?php echo $pedido['fecha']; ?></td>
                        <td><?php echo $pedido['estado']; ?></td>
                        <td><?php echo $pedido['total']; ?>€</td>
                        <td><a href="detalle.php?id=<?php echo $pedido['id']; ?>" class="btn">Ver Detalles</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../../templates/footer.php'; ?>
    <?php include '../../templates/whatsapp.php'; ?> <!-- Icono de WhatsApp -->
</body>
</html>