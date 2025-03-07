<?php
// Datos de conexión a la base de datos
$host = 'localhost';      // Servidor de la base de datos
$db   = 'almidonadas';    // Nombre de la base de datos
$user = 'root';           // Usuario de MySQL (por defecto es 'root' en XAMPP)
$pass = '';               // Contraseña de MySQL (por defecto está vacía en XAMPP)

try {
    // Crear una instancia de PDO para la conexión
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Configurar el modo de error para lanzar excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configurar el juego de caracteres a UTF-8
    $conn->exec("SET NAMES 'utf8'");
    
} catch (PDOException $e) {
    // En caso de error, mostrar un mensaje
    die("Error de conexión: " . $e->getMessage());
}
?>