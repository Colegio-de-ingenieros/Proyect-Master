window.onload = function () {
    obtener_Datos()
}

//Se ejecuta al cargar la pagina, muestra los datos del gasto en las cajas de texto
function obtener_Datos(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idOperacion = split[3];
    var aux="gasto"

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
            document.getElementById("gastos_Tipo_Gasto").innerHTML = "";
            document.getElementById("gastos_monto").innerHTML = "";
            document.getElementById("gastos_Fecha").innerHTML = "";

            for (var i = 1; i < 6; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = data[i][0];
                optionElement.text = data[i][1];
                document.getElementById("gastos_Tipo_Gasto").appendChild(optionElement);
            }

            document.getElementById("gastos_Tipo_Gasto").value=data[0][2];
            document.getElementById("gastos_monto").value = data[0][0];
            document.getElementById("gastos_Fecha").value = data[0][1];
            document.getElementById('doc_gasto_viejo').setAttribute('href', '../../controller/comprobantes/administrativo/gastos/'+idOperacion+'.pdf');
            
        }) 
}

//responde cuando hay un click en el boton actualizar
formulario_Gastos.addEventListener('submit', function (e){
    e.preventDefault();
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var participante = split[1];
    var idOperacion = split[3];
    var aux="gasto"

    let url = "../../controller/administrativo/Modificar_Gastos_Ingresos.php";

    let form = new FormData(formulario_Gastos);
    form.append("idOperacion", idOperacion);
    form.append("aux", aux);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            alert(data);
            if (data=='Actualización exitosa'){
                window.location.href='../../view/administrativo/Accion_Participante.html?participante='+participante;
            }
    })  
})

//responde cuando hay un click en el boton cancelar
formulario_Gastos.cancelar.addEventListener('click', function (e){
    e.preventDefault();
    console.log("auch")
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var participante = split[1];

    var resp = confirm("Los cambios realizados no se guardarán, ¿Desea continuar?");
    if(resp ==  true){
      window.location.href='../../view/administrativo/Accion_Participante.html?participante='+participante;
    }

    
})