<?php
session_start();
include 'includes/conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['register-name'];
    $email = $_POST['register-email'];
    $password = password_hash($_POST['register-password'], PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO Usuarios (nombre, email, password, role) VALUES (:nombre, :email, :password, 'cliente')");
    $stmt->execute([
        'nombre' => $name,
        'email' => $email,
        'password' => $password
    ]);

    // Redirigir al usuario después del registro
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Almidonadas</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="container">
        <h1>Regístrate en Almidonadas</h1>
        <form action="registro.php" method="POST" class="register-form">
            <label for="register-name">Nombre:</label>
            <input
                type="text"
                id="register-name"
                name="register-name"
                placeholder="Juan Pérez"
                required
            />

            <label for="register-email">Correo Electrónico:</label>
            <input
                type="email"
                id="register-email"
                name="register-email"
                placeholder="ejemplo@correo.com"
                required
            />

            <label for="register-password">Contraseña:</label>
            <input
                type="password"
                id="register-password"
                name="register-password"
                placeholder="Crea una contraseña"
                required
            />

            <button type="submit" class="btn">Registrarse</button>
        </form>
        <p class="info-text">
            ¿Ya tienes una cuenta? <a href="index.php" class="link">Inicia sesión aquí</a>.
        </p>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>
</html>