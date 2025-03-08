<?php
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/auth.php'; // Ruta absoluta
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/conexion.php'; // Ruta absoluta

// Verificar si el carrito está vacío
if (empty($_SESSION['carrito'])) {
    header('Location: ../carrito/index.php');
    exit();
}

// Procesar el pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['user_id'];
    $total = 0;

    // Calcular el total del pedido
    foreach ($_SESSION['carrito'] as $id => $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Insertar el pedido en la base de datos
    $stmt = $conn->prepare("INSERT INTO Pedidos (usuario_id, total) VALUES (:usuario_id, :total)");
    $stmt->execute([
        'usuario_id' => $usuario_id,
        'total' => $total
    ]);
    $pedido_id = $conn->lastInsertId();

    // Insertar los detalles del pedido
    foreach ($_SESSION['carrito'] as $id => $item) {
        $stmt = $conn->prepare("INSERT INTO DetallesPedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES (:pedido_id, :producto_id, :cantidad, :precio_unitario)");
        $stmt->execute([
            'pedido_id' => $pedido_id,
            'producto_id' => $id,
            'cantidad' => $item['cantidad'],
            'precio_unitario' => $item['precio']
        ]);
    }

    // Vaciar el carrito
    $_SESSION['carrito'] = [];

    // Redirigir al seguimiento de pedidos
    header('Location: seguimiento.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Realizar Pedido</h1>
        <form action="hacer_pedido.php" method="POST">
            <p><strong>Total:</strong> <?php
                $total = 0;
                foreach ($_SESSION['carrito'] as $id => $item) {
                    $total += $item['precio'] * $item['cantidad'];
                }
                echo $total;
            ?>€</p>
            <button type="submit" class="btn">Confirmar Pedido</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
    <?php include '../../templates/whatsapp.php'; ?> <!-- Icono de WhatsApp -->
</body>
</html>