<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAuthenticated(); // Redirigir si no está autenticado
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Iniciar la sesión del carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Añadir producto al carrito
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Productos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] += 1;
        } else {
            $_SESSION['carrito'][$id] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }
    }
    header('Location: index.php');
    exit();
}

// Eliminar producto del carrito
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
    header('Location: index.php');
    exit();
}

// Actualizar cantidad de productos en el carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cantidad'])) {
    foreach ($_POST['cantidad'] as $id => $cantidad) {
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
        }
    }
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Carrito de Compras</h1>
        <form action="index.php" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['carrito'] as $id => $item):
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $item['nombre']; ?></td>
                            <td><?php echo $item['precio']; ?>€</td>
                            <td><input type="number" name="cantidad[<?php echo $id; ?>]" value="<?php echo $item['cantidad']; ?>" min="1"></td>
                            <td><?php echo $subtotal; ?>€</td>
                            <td><a href="index.php?action=remove&id=<?php echo $id; ?>" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total:</strong> <?php echo $total; ?>€</p>
            <button type="submit" class="btn">Actualizar Carrito</button>
            <a href="../pedidos/hacer_pedido.php" class="btn">Realizar Pedido</a>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
    <?php include '../../templates/whatsapp.php'; ?> <!-- Icono de WhatsApp -->
</body>
</html>