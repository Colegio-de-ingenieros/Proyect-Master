window.onload = function () {
    obtener_Datos()
}

function obtener_Datos(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idP = split[1];

    let url = "../../controller/administrativo/Get_Proyecto.php";

    let form = new FormData();
    form.append("idP", idP);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById("idp").innerHTML = "";
            document.getElementById("nom_proyecto").innerHTML = "";
            document.getElementById("ini_proyecto").innerHTML = "";
            document.getElementById("fin_proyecto").innerHTML = "";
            document.getElementById("monto_proyecto").innerHTML = "";
            document.getElementById("obj_proyecto").innerHTML = "";

            document.getElementById("idp").value=data[0][0];
            document.getElementById("nom_proyecto").value=data[0][1];
            document.getElementById("ini_proyecto").value=data[0][2];
            document.getElementById("fin_proyecto").value=data[0][3];
            document.getElementById("monto_proyecto").value=data[0][5];
            document.getElementById("obj_proyecto").value=data[0][4];

        }) 
}


//responde cuando hay un click en el boton actualizar
formularioProyectos.addEventListener('submit', function (e){
    e.preventDefault();
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idP= split[1];


    let url = "../../controller/administrativo/Modificar_Proyectos.php";

    let form = new FormData(formularioProyectos);
    form.append("idP", idP);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            alert(data);
            if (data=='Actualización exitosa'){
                window.location.href='../../view/administrativo/Vista_Proyectos.html';
            }
    })  
})

//responde cuando hay un click en el boton cancelar
formularioProyectos.cancelar.addEventListener('click', function (e){
    e.preventDefault();
    let urlAct = window.location+''

    var resp = confirm("Los cambios realizados no se guardarán, ¿Desea continuar?");
    if(resp ==  true){
      window.location.href='../../view/administrativo/Vista_Proyectos.html';
    }

    
})