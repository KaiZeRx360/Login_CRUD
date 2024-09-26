<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Debug: Verifica los datos en la sesión
    /* echo '<pre>';
    print_r($_SESSION['usuarios']);
    echo '</pre>'; */

    // Verificar si el usuario está registrado
    if (isset($_SESSION['usuarios'][$email])) {
        // Comparar la contraseña (en un entorno real, deberías comparar hashes)
        if ($_SESSION['usuarios'][$email]['password'] === $password) {
            $_SESSION['user'] = $email; // Guardar el email en la sesión
            /* header('Location: ../../bienvenida.php');
            exit(); */
            echo json_encode([1,"Datos de acceso correctos"]);
        } else {
            echo json_encode([0, "Password erroneo!"]);
        }
    } else {
        echo json_encode([0, "Email no encontrado"]);
    }
}

// Redirigir de vuelta al login si hay error
/* header('Location: ../../login.php?error=1');
exit(); */
?>
