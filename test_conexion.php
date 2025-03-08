<?php
include 'includes/conexion.php';

try {
    // Ejecutar una consulta de prueba
    $stmt = $conn->query("SELECT * FROM Usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los resultados
    echo "<pre>";
    print_r($usuarios);
    echo "</pre>";
} catch (PDOException $e) {
    die("Error al ejecutar la consulta: " . $e->getMessage());
}
?>