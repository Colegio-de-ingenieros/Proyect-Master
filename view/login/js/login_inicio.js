//este script se ejecuta al inicio para ver si ya se habia iniciado sesion anteriormente
//si era asi entonces que lo reedirija, si no, no hace nada
fetch("../../controller/login/login.php",
    {
        method: "POST"
    })
    .then(response => response.json())
    .then(respuesta => {
        if (respuesta[0] == 1) {
            window.location.href = respuesta[1];
        }

    });