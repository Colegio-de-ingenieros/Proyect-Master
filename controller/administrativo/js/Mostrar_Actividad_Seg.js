let tipo;
window.onload = function () {
    obtener_Datos() 
    rellenar_tabla()
}

function obtener_URL(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    return split
}

//Llena las secciones de instructores y participantes
function obtener_Datos(){
    split=obtener_URL()
    let tipoAct = split[1]
    let idAct=split[2]
    let valueHidden = 1; 

    let url = "../../controller/administrativo/Mostrar_Actividad_Seg.php";

    let form = new FormData();
    form.append("valueHidden", valueHidden);
    form.append("tipoAct", tipoAct);
    form.append("idAct", idAct);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
        console.log(data)
        rellenar_datos(data);
    }) 
}

function rellenar_datos(datos) {
    split=obtener_URL()
    let tipoAct = split[1]
    if (tipoAct=="Certificacion"){
        tipoAct="Certificación"
    }
    registro=datos[0]
    let titulo= tipoAct + ": " + registro[0][0]
    document.getElementById('encabezado').innerHTML = titulo;
    document.getElementById("participante_Socio_Aso").innerHTML = "";
    document.getElementById("participante_Empresas").innerHTML = "";
    document.getElementById("participante_Instructores").innerHTML = "";
    document.getElementById("gastos_participante").innerHTML = "";
    document.getElementById("gastos_Tipo_Gasto").innerHTML = "";
    document.getElementById("ingresos_Participante").innerHTML = "";
    for (var i = 1; i < 7; i++) {
        dato=datos[i]
        if (i==1){
            campo="participante_Socio_Aso"
            nomCampo="No hay socios/asociados"
        }else if(i==2){
            campo="participante_Empresas"
            nomCampo="No hay empresas"
        }else if(i==3){
            campo="participante_Instructores"
            nomCampo="No hay instructores"
        }else if(i==4){
            campo="gastos_participante"
            nomCampo="No hay socios / asociados"
        }else if(i==5){
            campo="gastos_Tipo_Gasto"
        }else{
            campo="ingresos_Participante"
            nomCampo="No hay socios / asociados"
        }
        if (dato.length != 0){
            dato.forEach(registro => {
                var optionElement = document.createElement("option");
                optionElement.value = registro[0];
                optionElement.text = registro[1];
                document.getElementById(campo).appendChild(optionElement);
            });

            if (i<4){
                document.ready = document.getElementById(campo).value = '0';
            }
            document.getElementById(campo).disabled = false;
        } else {
            var optionElement = document.createElement("option");
            optionElement.value = "Vacio";
            optionElement.text = nomCampo + " para añadir";
            document.getElementById(campo).appendChild(optionElement);
            document.getElementById(campo).disabled = true;
        } 
    }
    valueHidden = 0; 
}

function rellenar_tabla(){
    split=obtener_URL()
    var tipoAct = split[1]
    var idAct=split[2]

    var actividad=tipoAct+"="+idAct;

    $.ajax({
        url: '../../controller/administrativo/Mostrar_Actividad_Tabla.php',
        type: 'POST',
        dataType: 'html',
        data: { idAct: idAct, actividad: actividad},
    })

        .done(function (respuesta)
        {
            $("#tablaResultado").html(respuesta);
        })
        .fail(function ()
        {
            console.log("error");
        })
}

//responde cuando hay un click en el boton uno
formulario_participantes.addEventListener('submit', function (e){
    e.preventDefault();
    let par =document.getElementById("participante_Socio_Aso").value;
    let emp = document.getElementById("participante_Empresas").value;
    let instr = document.getElementById("participante_Instructores").value;
    if (par=="" && emp=="" && instr==""){
        alert("Por favor, seleccione un participante.");
    }else if (par=="" && (document.getElementById("participante_Empresas").disabled == true) && (document.getElementById("participante_Instructores").disabled == true)){
        alert("Por favor, seleccione un participante.");
    }else if (emp=="" && (document.getElementById("participante_Socio_Aso").disabled == true) && (document.getElementById("participante_Instructores").disabled == true)){
        alert("Por favor, seleccione un participante.");
    }else if (instr=="" && (document.getElementById("participante_Empresas").disabled == true) && (document.getElementById("participante_Socio_Aso").disabled == true)){
        alert("Por favor, seleccione un participante.");
    }else if ((document.getElementById("participante_Socio_Aso").disabled == true) && (document.getElementById("participante_Empresas").disabled == true) && (document.getElementById("participante_Instructores").disabled == true)){
        alert("No hay más participantes para añadir");
    }else{
        split=obtener_URL()
        let idAct=split[2]
        let valueHidden = 2;

        let url = "../../controller/administrativo/Mostrar_Actividad_Seg.php";

        let form = new FormData(formulario_participantes);
        form.append("valueHidden", valueHidden);
        form.append("idAct", idAct);
        fetch(url, {
        method: "POST",
        body: form
        })
            .then(response => response.json())
            .then(data => {
                alert(data);
            if (data==="Participante añadido exitosamente"){
                    obtener_Datos() 
                    //const tabla = document.querySelector('#cuerpo').innerHTML=""; 
                    rellenar_tabla()
            }

        }) 
    }
})

//responde cuando hay un click en el boton dos
formulario_Gastos.addEventListener('submit', function (e){
    e.preventDefault();
    let valueHidden = 3;

    let url = "../../controller/administrativo/Mostrar_Actividad_Seg.php";

    let form = new FormData(formulario_Gastos);
    form.append("valueHidden", valueHidden);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            alert(data);
        if (data==="Gasto registrado exitosamente"){
            document.getElementById("gastos_monto").value = "";
            document.getElementById("gastos_Fecha").value = "";
            document.getElementById("gastos_comprobante").value = "";
            //const tabla = document.querySelector('#cuerpo').innerHTML=""; 
            rellenar_tabla()
        }

    }) 
})

//responde cuando hay un click en el boton tres
formulario_Ingresos.addEventListener('submit', function (e){
    e.preventDefault();
    let valueHidden = 4;

    let url = "../../controller/administrativo/Mostrar_Actividad_Seg.php";

    let form = new FormData(formulario_Ingresos);
    form.append("valueHidden", valueHidden);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
        alert(data);
        if (data==="Ingreso registrado exitosamente"){
            document.getElementById("ingresos_monto").value = "";
            document.getElementById("ingresos_Fecha").value = "";
            document.getElementById("ingresos_comprobante").value = "";
            //const tabla = document.querySelector('#cuerpo').innerHTML=""; 
            rellenar_tabla()
        }
    }) 
})