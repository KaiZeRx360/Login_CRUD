<?php
session_start();
require_once './app/config/dependencias.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre']) || !isset($_SESSION['apellido'])) {
    // Si no hay sesión iniciada, redirigir al login
    header("Location: login.php");
    exit();
}
?>