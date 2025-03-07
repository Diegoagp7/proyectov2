<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/navbar_admin.php'; ?> <!-- Navbar del administrador -->
    <div class="container">
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="catalogo/list.php">Catálogo</a></li>
                <li><a href="pedidos/list.php">Pedidos</a></li>
                <li><a href="usuarios/list.php">Usuarios</a></li>
                <li><a href="contenido/list.php">Contenido Exclusivo</a></li>
            </ul>
        </nav>
    </div>
    <?php include '../../templates/footer.php'; ?> <!-- Footer común -->
</body>
</html>