<?php
include '../../includes/auth.php'; // Incluir la lógica de autenticación
redirectIfNotAdmin(); // Redirigir si no es administrador
include '../../includes/conexion.php'; // Incluir la conexión a la base de datos

// Obtener el ID del producto a eliminar
$id = $_GET['id'];

// Eliminar el producto de la base de datos
$stmt = $conn->prepare("DELETE FROM Productos WHERE id = :id");
$stmt->execute(['id' => $id]);

// Redirigir a la lista de productos
header('Location: list.php');
exit();
?>