<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Gestión de Productos</title>
    <style>
        body {
            background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .card {
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card h1 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        .btn {
            border-radius: 10px;
            padding: 6px 10px;
            font-size: 0.75rem;
            border: none; /* Elimina el borde */
        }
        .btn-danger {
            background-image: linear-gradient(to top, #ff6b6b 0%, #c76b8c 100%);
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #e63946;
        }
        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1><i class="fas fa-user-check"></i> Bienvenido, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <a href="./app/controller/logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        <br>
        <form id="formProducto" class="mt-4">
            <input type="hidden" name="index" value="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio" id="precio" required min="0">
            </div>
            <button type="submit" class="btn btn-success w-100">Registrar Producto</button>
        </form>
        <div id="mensaje" class="mt-3"></div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="listaProductos"></tbody>
        </table>
    </div>
    <script src="./public/js/main3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
