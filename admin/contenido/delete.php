<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID del contenido a eliminar
$id = $_GET['id'];

// Eliminar el contenido de la base de datos
$stmt = $conn->prepare("DELETE FROM ContenidoExclusivo WHERE id = :id");
$stmt->execute(['id' => $id]);

// Redirigir a la lista de contenido
header('Location: list.php');
exit();
?>