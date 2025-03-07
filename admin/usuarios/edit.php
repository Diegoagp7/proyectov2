<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID del usuario a editar
$id = $_GET['id'];

// Obtener los datos del usuario
$stmt = $conn->prepare("SELECT * FROM Usuarios WHERE id = :id");
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Procesar el formulario de editar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña
    $role = $_POST['role'];

    // Actualizar el usuario en la base de datos
    $stmt = $conn->prepare("UPDATE Usuarios SET nombre = :nombre, email = :email, password = :password, role = :role WHERE id = :id");
    $stmt->execute([
        'nombre' => $nombre,
        'email' => $email,
        'password' => $password,
        'role' => $role,
        'id' => $id
    ]);

    // Redirigir a la lista de usuarios
    header('Location: list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            
            <label for="role">Rol:</label>
            <select name="role" required>
                <option value="admin" <?php echo ($usuario['role'] === 'admin') ? 'selected' : ''; ?>>Administrador</option>
                <option value="cliente" <?php echo ($usuario['role'] === 'cliente') ? 'selected' : ''; ?>>Cliente</option>
            </select>
            
            <button type="submit" class="btn">Guardar Cambios</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>