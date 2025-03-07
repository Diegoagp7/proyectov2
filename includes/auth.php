<?php
session_start(); // Iniciar la sesión

// Función para verificar si el usuario está autenticado
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

// Función para verificar si el usuario es administrador
function isAdmin() {
    return isAuthenticated() && $_SESSION['role'] === 'admin';
}

// Función para verificar si el usuario es cliente
function isCliente() {
    return isAuthenticated() && $_SESSION['role'] === 'cliente';
}

// Función para redirigir a los usuarios no autenticados
function redirectIfNotAuthenticated() {
    if (!isAuthenticated()) {
        header('Location: ../index.php');
        exit();
    }
}

// Función para redirigir a los usuarios no autorizados
function redirectIfNotAdmin() {
    if (!isAdmin()) {
        header('Location: ../cliente/index.php');
        exit();
    }
}
?>