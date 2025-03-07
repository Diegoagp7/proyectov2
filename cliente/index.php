<?php
include '../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAuthenticated(); // Redirigir si no está autenticado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Almidonadas</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>
    <div class="cliente-container">
        <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?></h1>
        <nav>
            <ul>
                <li><a href="catalogo/list.php">Catálogo</a></li>
                <li><a href="carrito/index.php">Carrito</a></li>
                <li><a href="pedidos/seguimiento.php">Pedidos</a></li>
                <li><a href="reseñas/list.php">Reseñas</a></li>
                <li><a href="contenido_exclusivo.php">Contenido Exclusivo</a></li>
            </ul>
        </nav>
    </div>
    <?php include '../templates/footer.php'; ?>
    <?php include '../../templates/whatsapp.php'; ?> <!-- Icono de WhatsApp -->
</body>
</html>