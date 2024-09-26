<?php
session_start();

// Inicializa los productos en la sesión si no existen
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

// Si es una petición para agregar o editar un producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = (float)$_POST['precio'];
    
    if (isset($_POST['index']) && is_numeric($_POST['index'])) {
        // Edita el producto si se proporciona el índice
        $index = (int)$_POST['index'];
        if (isset($_SESSION['productos'][$index])) {
            $_SESSION['productos'][$index] = ['nombre' => $nombre, 'precio' => $precio];
        }
    } else {
        // Agrega un nuevo producto si no se especifica índice
        $_SESSION['productos'][] = ['nombre' => $nombre, 'precio' => $precio];
    }

    echo json_encode(['success' => true, 'productos' => $_SESSION['productos']]);
    exit();
}

// Si es una petición para eliminar un producto
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $index = (int)$_DELETE['index'];

    if (isset($_SESSION['productos'][$index])) {
        array_splice($_SESSION['productos'], $index, 1);
        echo json_encode(['success' => true, 'productos' => $_SESSION['productos']]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit();
}

// Si es una petición GET, simplemente devuelve la lista de productos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(['productos' => $_SESSION['productos']]);
    exit();
}