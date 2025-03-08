<?php
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/auth.php'; // Ruta absoluta
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/conexion.php'; // Ruta absoluta

// Obtener el contenido exclusivo
$stmt = $conn->query("SELECT * FROM ContenidoExclusivo");
$contenido = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido Exclusivo - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Contenido Exclusivo</h1>
        <div class="contenido-grid">
            <?php foreach ($contenido as $item): ?>
                <div class="contenido-item">
                    <h2><?php echo $item['titulo']; ?></h2>
                    <p><?php echo $item['descripcion']; ?></p>
                    <img src="<?php echo $item['imagen']; ?>" alt="<?php echo $item['titulo']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>