<?php
// Usar rutas absolutas para incluir los archivos
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/auth.php'; // Ruta absoluta
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/conexion.php'; // Ruta absoluta

// Obtener todos los pedidos
$stmt = $conn->query("SELECT * FROM Pedidos");
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos - Almidonadas</title>
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/almidonadas1/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Pedidos</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
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
                        <td><?php echo $pedido['usuario_id']; ?></td>
                        <td><?php echo $pedido['fecha']; ?></td>
                        <td><?php echo $pedido['estado']; ?></td>
                        <td><?php echo $pedido['total']; ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo $pedido['id']; ?>" class="btn">Ver Detalles</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>