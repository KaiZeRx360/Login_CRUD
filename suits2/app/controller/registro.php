<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $errors = [];

    
    if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
        $errors[] = "Todos los campos son obligatorios.";
    }

    
    if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
        $errors[] = "El nombre solo debe contener letras y espacios.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $apellido)) {
        $errors[] = "El apellido solo debe contener letras y espacios.";
    }

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico no tiene un formato válido.";
    }

    if (count($errors) > 0) {
        echo json_encode([0, $errors]);
    } else {
        
        $_SESSION['usuarios'][$email] = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'password' => $password 
        ];

        echo json_encode([1, "Registro exitoso"]);
    }
}
?>