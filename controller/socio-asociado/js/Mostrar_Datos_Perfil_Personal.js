//responde cuando hay un click en el boton actualizar
formulario.addEventListener('submit', function (e){
    e.preventDefault();
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idP= split[1];


    let url = "../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";

    let form = new FormData(formulario);
    form.append("idP", idP);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            if (data==='exito'){
                alert("Actualización exitosa");
                window.location.href='../../view/socio-asociado/Vista_Cursos.html';
            }
    })  
})