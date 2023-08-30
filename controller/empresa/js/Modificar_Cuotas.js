//responde cuando hay un click en el boton actualizar
formulario.addEventListener('submit', function (e){
    e.preventDefault();
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idP= split[1];


    let url = "../../controller/empresa/Modificar_Cuotas.php";

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
                window.location.href='../../view/empresa/Vista_Cuotas.html';
            }else if(data==='fechas'){
                alert("Fecha de finalización debe ser posterior a fecha de inicio");
            }
    })  
})

//responde cuando hay un click en el boton cancelar
formulario.cancelar.addEventListener('click', function (e){
    e.preventDefault();
    let urlAct = window.location+''

    var resp = confirm("Los cambios realizados no se guardarán, ¿desea continuar?");
    if(resp ==  true){
      window.location.href='../../view/empresa/Vista_Cuotas.html';
    }

    
})