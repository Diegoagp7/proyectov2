<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Procesar el formulario de añadir usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña
    $role = $_POST['role'];

    // Insertar el usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO Usuarios (nombre, email, password, role) VALUES (:nombre, :email, :password, :role)");
    $stmt->execute([
        'nombre' => $nombre,
        'email' => $email,
        'password' => $password,
        'role' => $role
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
    <title>Añadir Usuario - Almidonadas</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div class="container">
        <h1>Añadir Usuario</h1>
        <form action="add.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            
            <label for="role">Rol:</label>
            <select name="role" required>
                <option value="admin">Administrador</option>
                <option value="cliente">Cliente</option>
            </select>
            
            <button type="submit" class="btn">Añadir Usuario</button>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>