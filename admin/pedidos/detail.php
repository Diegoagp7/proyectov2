<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID del pedido
$id = $_GET['id'];

// Obtener los detalles del pedido
$stmt = $conn->prepare("SELECT * FROM Pedidos WHERE id = :id");
$stmt->execute(['id' => $id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener los detalles de los productos del pedido
$stmt = $conn->prepare("SELECT * FROM DetallesPedido WHERE pedido_id = :pedido_id");
$stmt->execute(['pedido_id' => $id]);
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Detalles del Pedido #<?php echo $pedido['id']; ?></h1>
        <p><strong>Usuario:</strong> <?php echo $pedido['usuario_id']; ?></p>
        <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
        <p><strong>Estado:</strong> <?php echo $pedido['estado']; ?></p>
        <p><strong>Total:</strong> <?php echo $pedido['total']; ?></p>
        
        <h2>Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles as $detalle): ?>
                    <tr>
                        <td><?php echo $detalle['producto_id']; ?></td>
                        <td><?php echo $detalle['cantidad']; ?></td>
                        <td><?php echo $detalle['precio_unitario']; ?></td>
                        <td><?php echo $detalle['cantidad'] * $detalle['precio_unitario']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>