<?php
include '../includes/auth.php'; // Incluir la lógica de autenticación
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Almidonadas</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include '../templates/navbar_admin.php'; ?> <!-- Navbar del administrador -->
    <div class="container admin-panel">
        <h1>Panel de Administración</h1>
        <nav class="admin-nav">
    <ul>
        <li><a href="?section=catalogo" class="<?php echo ($_GET['section'] ?? '') === 'catalogo' ? 'active' : ''; ?>">Catálogo</a></li>
        <li><a href="?section=pedidos" class="<?php echo ($_GET['section'] ?? '') === 'pedidos' ? 'active' : ''; ?>">Pedidos</a></li>
        <li><a href="?section=usuarios" class="<?php echo ($_GET['section'] ?? '') === 'usuarios' ? 'active' : ''; ?>">Usuarios</a></li>
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
                    case 'pedidos':
                        include 'pedidos/list.php';
                        break;
                    case 'usuarios':
                        include 'usuarios/list.php';
                        break;
                    case 'contenido':
                        include 'contenido/list.php';
                        break;
                    default:
                        echo "<p>Selecciona una sección del menú.</p>";
                        break;
                }
            } else {
                echo "<p>Bienvenido al panel de administración. Selecciona una sección del menú.</p>";
            }
            ?>
        </div>
    </div>
    <?php include '../templates/footer.php'; ?> <!-- Footer común -->
</body>
</html>