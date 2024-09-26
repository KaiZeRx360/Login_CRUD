document.addEventListener("DOMContentLoaded", () => {
    const formProducto = document.getElementById('formProducto');
    const listaProductos = document.getElementById('listaProductos');
    const mensaje = document.getElementById('mensaje');

    // Cargar productos al inicio
    cargarProductos();

    formProducto.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita el envío del formulario

        const formData = new FormData(formProducto);
        fetch('./app/controller/productos.php', { // Asegúrate de cambiar esta ruta al nombre correcto de tu archivo PHP
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mensaje.innerHTML = '<div class="alert alert-success">Producto registrado exitosamente.</div>';
                cargarProductos(); // Recargar la lista de productos
                formProducto.reset(); // Reiniciar el formulario
            } else {
                mensaje.innerHTML = '<div class="alert alert-danger">Error al registrar el producto.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mensaje.innerHTML = '<div class="alert alert-danger">Error al procesar la solicitud.</div>';
        });
    });

    const cargarProductos = () => {
        fetch('./app/controller/productos.php') // Asegúrate de cambiar esta ruta al nombre correcto de tu archivo PHP
        .then(response => response.json())
        .then(data => {
            listaProductos.innerHTML = '';
            data.productos.forEach((producto, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${producto.nombre}</td>
                    <td>${producto.precio}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editarProducto(${index}, '${producto.nombre}', ${producto.precio})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarProducto(${index})">Eliminar</button>
                    </td>
                `;
                listaProductos.appendChild(row);
            });
        });
    };

    window.editarProducto = (index, nombre, precio) => {
        document.querySelector('input[name="index"]').value = index; // Establecer el índice en el campo oculto
        document.getElementById('nombre').value = nombre; // Llenar el nombre del producto
        document.getElementById('precio').value = precio; // Llenar el precio del producto
    };

    window.eliminarProducto = (index) => {
        fetch('./app/controller/productos.php', {
            method: 'DELETE',
            body: new URLSearchParams({ index })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cargarProductos(); // Recargar la lista de productos
                mensaje.innerHTML = '<div class="alert alert-success">Producto eliminado exitosamente.</div>'; // Alerta de éxito
            } else {
                mensaje.innerHTML = '<div class="alert alert-danger">Error al eliminar el producto.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mensaje.innerHTML = '<div class="alert alert-danger">Error al procesar la solicitud.</div>';
        });
    };
});
