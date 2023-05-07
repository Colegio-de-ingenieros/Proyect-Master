window.onload = function () {
    let url = "../../controller/administrativo/Mostrar_Instructores.php";
    let datos = new FormData();
    datos.append("id", 1);

    fetch(url, {
        method: 'POST',
        body: datos
    })
    .then((response) => response.json())
    .then((json) => respuesta(json))
    .catch((error) => alert(error));

    function respuesta(json) {
        console.log(json);
    }
};