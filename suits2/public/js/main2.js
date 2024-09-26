const enviar_datos = () => {
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;


    const nombreValido = /^[A-Za-z\s]+$/;
    if (!nombreValido.test(nombre)) {
        alert("El nombre solo debe contener letras y espacios.");
        return;
    }
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailValido.test(email)) {
        alert("Por favor, ingrese un correo electrónico válido.");
        return;
    }
    if (!nombre || !apellido || !email || !password) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    let data = new FormData();
    data.append("nombre", nombre);
    data.append("apellido", apellido);
    data.append("email", email);
    data.append("password", password);

    fetch("app/controller/registro.php", {
        method: "POST",
        body: data
    }).then(respuesta => respuesta.json())
    .then(respuesta => {
        if (respuesta[0] == 1) {
            alert(respuesta[1]);
            window.location.href = "login.php";
        } else {
            alert(respuesta[1].join("\n"));
        }
    }).catch(error => {
        console.error("Error:", error);
        alert("Hubo un problema con el registro. Intente nuevamente.");
    });
}


document.getElementById("btn_registrar").addEventListener("click", () => {
    enviar_datos();
});