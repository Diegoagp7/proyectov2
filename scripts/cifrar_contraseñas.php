<?php
include '../includes/conexion.php'; // Asegúrate de que la ruta sea correcta

// Obtener todos los usuarios
$stmt = $conn->query("SELECT id, password FROM Usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $id = $usuario['id'];
    $password = $usuario['password'];

    // Cifrar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $stmt = $conn->prepare("UPDATE Usuarios SET password = :password WHERE id = :id");
    $stmt->execute(['password' => $hashedPassword, 'id' => $id]);
}

echo "Contraseñas cifradas correctamente.";
?>