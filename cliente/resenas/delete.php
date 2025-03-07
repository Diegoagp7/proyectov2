<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAuthenticated(); // Redirigir si no está autenticado
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID de la reseña a eliminar
$id = $_GET['id'];

// Eliminar la reseña de la base de datos
$stmt = $conn->prepare("DELETE FROM Reseñas WHERE id = :id");
$stmt->execute(['id' => $id]);

// Redirigir a la lista de reseñas
header('Location: list.php');
exit();
?>