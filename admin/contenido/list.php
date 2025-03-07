<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener todo el contenido exclusivo
$stmt = $conn->query("SELECT * FROM ContenidoExclusivo");
$contenido = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contenido Exclusivo - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Lista de Contenido Exclusivo</h1>
        <a href="add.php" class="btn">Añadir Contenido</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contenido as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['titulo']; ?></td>
                        <td><?php echo $item['descripcion']; ?></td>
                        <td><?php echo $item['imagen']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn">Editar</a>
                            <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>