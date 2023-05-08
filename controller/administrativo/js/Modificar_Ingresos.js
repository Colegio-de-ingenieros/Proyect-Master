window.onload = function () {
    obtener_Datos()
}

function obtener_Datos(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idOperacion = split[3];
    var aux="ingreso"

    let url = "../../controller/administrativo/Get_Gastos_Ingresos.php";

    let form = new FormData();
    form.append("aux", aux);
    form.append("idOperacion", idOperacion);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById("ingresos_monto").innerHTML = "";
            document.getElementById("ingresos_Fecha").innerHTML = "";

            document.getElementById("ingresos_monto").value = data[0][0];
            document.getElementById("ingresos_Fecha").value = data[0][1];
        }) 
}

//responde cuando hay un click en el boton uno
formulario_Ingresos.cancelar.addEventListener('click', function (e){
    e.preventDefault();
    console.log("auchIngresos")
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var participante = split[1];

    var resp = confirm("Los cambios realizados no se guardarán, ¿Desea continuar?");
    if(resp ==  true){
      //location.href = '../../view/administrativo/Vista_Certificaciones.php';
      window.location.href='../../view/administrativo/Accion_Participante.html?participante='+participante;
    }

    
})