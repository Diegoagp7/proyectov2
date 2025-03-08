<?php
include '../includes/auth.php'; // Incluir la lógica de autenticación
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
    <?php include '../templates/navbar_cliente.php'; ?>
    <div class="container cliente-container">
        <h1>Bienvenido Cliente</h1>
        <nav class="admin-nav">
        <ul>
        <li><a href="?section=catalogo" class="<?php echo ($_GET['section'] ?? '') === 'catalogo' ? 'active' : ''; ?>">Catálogo</a></li>
        <li><a href="?section=carrito" class="<?php echo ($_GET['section'] ?? '') === 'carrito' ? 'active' : ''; ?>">Carrito</a></li>
        <li><a href="?section=pedidos" class="<?php echo ($_GET['section'] ?? '') === 'pedidos' ? 'active' : ''; ?>">Pedidos</a></li>
        <li><a href="?section=seguimiento" class="<?php echo ($_GET['section'] ?? '') === 'seguimiento' ? 'active' : ''; ?>">Seguimiento de Pedidos</a></li>
        <li><a href="?section=resenas" class="<?php echo ($_GET['section'] ?? '') === 'resenas' ? 'active' : ''; ?>">Reseñas</a></li>
        <li><a href="?section=contenido" class="<?php echo ($_GET['section'] ?? '') === 'contenido' ? 'active' : ''; ?>">Contenido Exclusivo</a></li>
    </ul>
</nav>

        <!-- Contenedor para el contenido dinámico -->
        <div id="dynamic-content" class="dynamic-content">
            <?php
            // Incluir contenido dinámico basado en el parámetro "section"
            if (isset($_GET['section'])) {
                $section = $_GET['section'];
                switch ($section) {
                    case 'catalogo':
                        include 'catalogo/list.php';
                        break;
                    case 'carrito':
                        include 'carrito/list.php';
                        break;
                    case 'pedidos':
                        include 'pedidos/hacer_pedido.php';
                        break;
                    case 'seguimiento':
                        include 'pedidos/seguimiento.php';
                        break;
                    case 'resenas':
                        include 'contenido/list.php';
                        break;
                    case 'contenido':
                        include 'contenido/list.php';
                        break;
                    default:
                        echo "<p>Selecciona una sección del menú.</p>";
                        break;
                }
            } else {
                echo "<p>Selecciona una sección del menú.</p>";
            }
            ?>
        </div>
    </div>
    <?php include '../templates/footer.php'; ?>
    <?php include '../templates/whatsapp.php'; ?>
</body>
</html>