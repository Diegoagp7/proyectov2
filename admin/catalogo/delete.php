<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/auth.php'; // Ruta absoluta
include $_SERVER['DOCUMENT_ROOT'] . '/almidonadas1/includes/conexion.php'; // Ruta absoluta

// Verificar si se recibió el ID del producto
if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    exit();
}

$id = $_GET['id'];

try {
    // Eliminar el producto de la base de datos
    $stmt = $conn->prepare("DELETE FROM Productos WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // Verificar si se eliminó correctamente
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró el producto']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto: ' . $e->getMessage()]);
}
?>