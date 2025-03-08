<?php
session_start();
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
    <title>Lista de Productos - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Productos</h1>
        <button onclick="mostrarFormulario('add')" class="btn">Añadir Producto</button>
        <div id="dynamic-content">
            <!-- Aquí se mostrarán los formularios y mensajes -->
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['id']; ?></td>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo $producto['descripcion']; ?></td>
                        <td><?php echo $producto['precio']; ?></td>
                        <td><?php echo $producto['categoria']; ?></td>
                        <td>
                            <button onclick="mostrarFormulario('edit', <?php echo $producto['id']; ?>)" class="btn">Editar</button>
                            <button onclick="eliminarProducto(<?php echo $producto['id']; ?>)" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Función para mostrar el formulario de añadir o editar
        function mostrarFormulario(accion, id = null) {
            const url = accion === 'add' ? 'add.php' : `edit.php?id=${id}`;
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('dynamic-content').innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
        }

        // Función para eliminar un producto
        function eliminarProducto(id) {
            if (confirm('¿Estás seguro de eliminar este producto?')) {
                fetch(`delete.php?id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Producto eliminado correctamente');
                        location.reload(); // Recargar la página para actualizar la lista
                    } else {
                        alert('Error al eliminar el producto');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>