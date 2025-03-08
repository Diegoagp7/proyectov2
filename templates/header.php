<?php
// Verificar si la sesión está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Almidonadas'; ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/images/logo.png" alt="Logo de Almidonadas">
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../catalogo/list.php">Catálogo</a></li>
                    <li><a href="../carrito/index.php">Carrito</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="../cliente/index.php">Mi Cuenta</a></li>
                        <li><a href="../includes/logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="../login.php">Iniciar Sesión</a></li>
                        <li><a href="../registro.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>