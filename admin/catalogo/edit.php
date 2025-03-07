<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID del producto a editar
$id = $_GET['id'];

// Obtener los datos del producto
$stmt = $conn->prepare("SELECT * FROM Productos WHERE id = :id");
$stmt->execute(['id' => $id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

// Procesar el formulario de editar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $imagen = $_POST['imagen'];

    // Actualizar el producto en la base de datos
    $stmt = $conn->prepare("UPDATE Productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, categoria = :categoria, imagen = :imagen WHERE id = :id");
    $stmt->execute([
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'precio' => $precio,
        'categoria' => $categoria,
        'imagen' => $imagen,
        'id' => $id
    ]);

    // Redirigir a la lista de productos
    header('Location: list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Editar Producto</h1>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
            
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
            
            <label for="categoria">Categoría:</label>
            <select name="categoria" required>
                <option value="tortas" <?php echo ($producto['categoria'] === 'tortas') ? 'selected' : ''; ?>>Tortas</option>
                <option value="galletas" <?php echo ($producto['categoria'] === 'galletas') ? 'selected' : ''; ?>>Galletas</option>
                <option value="quesillos" <?php echo ($producto['categoria'] === 'quesillos') ? 'selected' : ''; ?>>Quesillos</option>
                <option value="postres" <?php echo ($producto['categoria'] === 'postres') ? 'selected' : ''; ?>>Postres</option>
            </select>
            
            <label for="imagen">Imagen (URL):</label>
            <input type="text" name="imagen" value="<?php echo $producto['imagen']; ?>" required>
            
            <button type="submit" class="btn">Guardar Cambios</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>