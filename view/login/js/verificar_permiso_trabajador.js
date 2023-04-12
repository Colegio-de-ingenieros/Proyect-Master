let formulario_data = new FormData();
formulario_data.append("acceso_a", "trabajador")
fetch("../../controller/login/verificar_sesion.php",
    {
        method: "POST",
        body: formulario_data
    })
    .then(response => response.json())
    .then(respuesta => {
        console.log(respuesta);
        if (respuesta[0] == 0) {
            window.location.href = '../../view/login/400.html';
        }

    });