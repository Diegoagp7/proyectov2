<?php
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/auth.php'; // Ruta absoluta
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/conexion.php'; // Ruta absoluta

// Obtener todos los productos
$stmt = $conn->query("SELECT * FROM Productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Catálogo de Productos</h1>
        <div class="productos-grid">
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                    <h2><?php echo $producto['nombre']; ?></h2>
                    <p><?php echo $producto['descripcion']; ?></p>
                    <p><strong>Precio:</strong> <?php echo $producto['precio']; ?>€</p>
                    <a href="../carrito/index.php?action=add&id=<?php echo $producto['id']; ?>" class="btn">Añadir al Carrito</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>