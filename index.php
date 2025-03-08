<?php
session_start(); // Iniciar la sesión
include 'includes/auth.php'; // Incluir el archivo con las funciones de autenticación
include 'includes/conexion.php'; // Incluir la conexión a la base de datos

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT * FROM Usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Depuración: Mostrar el usuario encontrado
   // echo "<pre>";
   // print_r($user);
   // echo "</pre>";

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user) {
        //  echo "Usuario encontrado.<br>";
        if (password_verify($password, $user['password'])) {
           // echo "Contraseña correcta.<br>";
            // Guardar los datos del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirigir según el rol del usuario
            if ($user['role'] === 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: cliente/index.php');
            }
            exit();
        } else {
            //echo "Contraseña incorrecta.<br>";
            $error = "Credenciales incorrectas.";
        }
    } else {
        //echo "Usuario no encontrado.<br>";
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almidonadas - Inicio</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="login-page">
    <!-- Contenedor Principal -->
    <div class="login-container">
        <h1 class="login-title">Bienvenido a Almidonadas</h1>
        <p class="login-subtitle">Inicia sesión o regístrate para continuar.</p>

        <!-- Contenedor de Formularios -->
        <div class="login-form-wrapper">
            <!-- Formulario de Inicio de Sesión -->
            <div class="login-form-container">
                <h2 class="login-form-title">Iniciar Sesión</h2>
                <?php if (isset($error)): ?>
                    <p class="login-error"><?php echo $error; ?></p>
                <?php endif; ?>
                <form action="index.php" method="POST" class="login-form">
                    <label for="email" class="login-label">Correo Electrónico:</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="ejemplo@correo.com"
                        class="login-input"
                        required
                    />

                    <label for="password" class="login-label">Contraseña:</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Ingresa tu contraseña"
                        class="login-input"
                        required
                    />

                    <button type="submit" class="login-button">Iniciar Sesión</button>
                </form>
            </div>

            <!-- Formulario de Registro -->
            <div class="login-form-container">
                <h2 class="login-form-title">Regístrate</h2>
                <form action="registro.php" method="POST" class="login-form">
                    <label for="register-name" class="login-label">Nombre:</label>
                    <input
                        type="text"
                        id="register-name"
                        name="register-name"
                        placeholder="Juan Pérez"
                        class="login-input"
                        required
                    />

                    <label for="register-email" class="login-label">Correo Electrónico:</label>
                    <input
                        type="email"
                        id="register-email"
                        name="register-email"
                        placeholder="ejemplo@correo.com"
                        class="login-input"
                        required
                    />

                    <label for="register-password" class="login-label">Contraseña:</label>
                    <input
                        type="password"
                        id="register-password"
                        name="register-password"
                        placeholder="Crea una contraseña"
                        class="login-input"
                        required
                    />

                    <button type="submit" class="login-button">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>