<?php
// auth.php

// Verifica si la función isAuthenticated ya existe
if (!function_exists('isAuthenticated')) {
    function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }
}

// Verifica si la función isAdmin ya existe
if (!function_exists('isAdmin')) {
    function isAdmin() {
        return isAuthenticated() && $_SESSION['role'] === 'admin';
    }
}

// Verifica si la función isCliente ya existe
if (!function_exists('isCliente')) {
    function isCliente() {
        return isAuthenticated() && $_SESSION['role'] === 'cliente';
    }
}

// Verifica si la función redirectIfNotAuthenticated ya existe
if (!function_exists('redirectIfNotAuthenticated')) {
    function redirectIfNotAuthenticated() {
        if (!isAuthenticated()) {
            header('Location: ../index.php');
            exit();
        }
    }
}

// Verifica si la función redirectIfNotAdmin ya existe
if (!function_exists('redirectIfNotAdmin')) {
    function redirectIfNotAdmin() {
        if (!isAdmin()) {
            header('Location: ../cliente/index.php');
            exit();
        }
    }
}
?>