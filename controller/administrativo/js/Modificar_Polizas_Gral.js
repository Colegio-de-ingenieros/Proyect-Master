window.onload = function () {
    obtener_Datos()
}

//Se ejecuta al cargar la pagina, muestra los datos de la poliza en las cajas de texto
function obtener_Datos(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idOperacion = split[1];
    var aux="datos"

    let url = "../../controller/administrativo/Get_Poliza_Gral.php";

    let form = new FormData();
    form.append("idOperacion", idOperacion);
    form.append("aux", aux);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            document.getElementById("tipo_poliza").innerHTML = ""; 
            document.getElementById("concepto_gen").innerHTML = "";
            document.getElementById("usuario").innerHTML = ""; 
            document.getElementById("nombre_us").innerHTML = "";
            document.getElementById("tipo_servicio").innerHTML = ""; 
            document.getElementById("nom_servicio").innerHTML = "";
            document.getElementById("nombre").innerHTML = "";
            document.getElementById("apellido_pat").innerHTML = "";
            document.getElementById("apellido_mat").innerHTML = "";

            tipoPol=data[0]
            for (var i = 0; i < 2; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = tipoPol[i][0];
                optionElement.text = tipoPol[i][1];
                document.getElementById("tipo_poliza").appendChild(optionElement);
            }
            tipoUsua=data[1]
            for (var i = 0; i < 3; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = tipoUsua[i][0];
                optionElement.text = tipoUsua[i][1];
                document.getElementById("usuario").appendChild(optionElement);
            }
            tipoSer=data[2]
            for (var i = 0; i < 5; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = tipoSer[i][0];
                optionElement.text = tipoSer[i][1];
                document.getElementById("tipo_servicio").appendChild(optionElement);
            }
            usuarios=data[4]
            for (var i = 0; i < usuarios.length; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = usuarios[i][0];
                optionElement.text = usuarios[i][1];
                document.getElementById("nombre_us").appendChild(optionElement);
            }
            servicios=data[6]
            for (var i = 0; i < servicios.length; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = servicios[i][0];
                optionElement.text = servicios[i][1];
                document.getElementById("nom_servicio").appendChild(optionElement);
            }

            datos=data[3]
            document.getElementById("nombre").value = datos[0][0];
            document.getElementById("apellido_pat").value = datos[0][1];
            document.getElementById("apellido_mat").value = datos[0][2];
            document.getElementById("concepto_gen").value=datos[0][3];
            document.getElementById("tipo_poliza").value=datos[0][4];
            document.getElementById("tipo_servicio").value=datos[0][5];
            document.getElementById("usuario").value=datos[0][6];
            document.getElementById("nombre_us").value=datos[0][7];

            datosSer=data[5]
            document.getElementById("nom_servicio").value=datosSer[0][0];
        }) 
}

formularioPolGral.usuario.addEventListener("change", (e) => {
    let tipoUsua =document.getElementById("usuario").value;
    var aux="usuario"
    let url = "../../controller/administrativo/Get_Poliza_Gral.php";
    let form = new FormData();
    form.append("idOperacion", tipoUsua);
    form.append("aux", aux);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById("nombre_us").innerHTML = "";
            console.log(data);
            if (data.length==0){
                if (tipoUsua==1){
                    msj="No hay socios registrados"
                  }else if(tipoUsua==2){
                    msj="No hay asociados registrados"
                  }else{
                    msj="No hay empresas registradas"
                  }
                var optionElement = document.createElement("option");
                optionElement.value = "Vacio";
                optionElement.text = msj;
                document.getElementById("nombre_us").appendChild(optionElement)
                document.getElementById("nombre_us").disabled = true;
            }else{
                document.getElementById("nombre_us").disabled = false;
                for (var i = 0; i < data.length; i++) {
                    var optionElement = document.createElement("option");
                    optionElement.value = data[i][0];
                    optionElement.text = data[i][1];
                    document.getElementById("nombre_us").appendChild(optionElement);
                }
            }
        }) 
})

formularioPolGral.tipo_servicio.addEventListener("change", (e) => {
    let tipoSer =document.getElementById("tipo_servicio").value;
    var aux="servicio"
    let url = "../../controller/administrativo/Get_Poliza_Gral.php";
    let form = new FormData();
    form.append("idOperacion", tipoSer);
    form.append("aux", aux);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById("nom_servicio").innerHTML = "";
            if (data.length==0){
                if (tipoSer==4){
                    msj="No hay cursos registrados"
                  }else if(tipoSer==5){
                    msj="No hay certificaciones registradas"
                  }
                var optionElement = document.createElement("option");
                optionElement.value = "Vacio";
                optionElement.text = msj;
                document.getElementById("nom_servicio").appendChild(optionElement)
                document.getElementById("nom_servicio").disabled = true;
            }else{
                document.getElementById("nom_servicio").disabled = false;
                for (var i = 0; i < data.length; i++) {
                    var optionElement = document.createElement("option");
                    optionElement.value = data[i][0];
                    optionElement.text = data[i][1];
                    document.getElementById("nom_servicio").appendChild(optionElement);
                }
            }
        }) 
})

//responde cuando hay un click en el boton actualizar
formularioPolGral.addEventListener('submit', function (e){
    e.preventDefault();
    if (document.getElementById("nombre_us").disabled == true) {
        alert("Por favor, seleccione un tipo de usuario que si tenga registros");
    } else if (document.getElementById("nom_servicio").disabled == true){
        alert("Por favor, seleccione un tipo de servicio que si tenga registros");
    } else{
        let urlAct = window.location+''
        let split = urlAct.split("=");
        var idOperacion = split[1];

        let url = "../../controller/administrativo/Modificar_Polizas_Gral.php";

        let form = new FormData(formularioPolGral);
        form.append("idOperacion", idOperacion);
        fetch(url, {
        method: "POST",
        body: form
        })
            .then(response => response.json())
            .then(data => {
                alert(data);
                if (data=='Actualización exitosa'){
                    window.location.href='../../view/administrativo/Vista_Polizas.html';
                }
        })  
    }
})

//responde cuando hay un click en el boton cancelar
formularioPolGral.cancelar.addEventListener('click', function (e){
    e.preventDefault();
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var participante = split[1];

    var resp = confirm("Los cambios realizados no se guardarán, ¿desea continuar?");
    if(resp ==  true){
      window.location.href='../../view/administrativo/Vista_Polizas.html';
    }

    
})