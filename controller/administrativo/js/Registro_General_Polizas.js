formularioPolGral.usuario.addEventListener("change", (e) => {
    let tipoUsua =document.getElementById("usuario").value;
    var aux="usuario"
    let url = "../../controller/administrativo/Get_Polizas.php";
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
            for (var i = 0; i < data.length; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = data[i][0];
                optionElement.text = data[i][1];
                document.getElementById("nombre_us").appendChild(optionElement);
            }
        }) 
})

formularioPolGral.tipo_servicio.addEventListener("change", (e) => {
    let tipoSer =document.getElementById("tipo_servicio").value;
    var aux="servicio"
    let url = "../../controller/administrativo/Get_Polizas.php";
    let form = new FormData();
    form.append("idOperacion", tipoSer);
    form.append("aux", aux);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById("nom_servicio").innerHTML = "";
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = data[i][0];
                optionElement.text = data[i][1];
                document.getElementById("nom_servicio").appendChild(optionElement);
            }
        }) 
})



var formulario = document.getElementById('formularioPolGral');
var respuesta = document.getElementById('respuesta');

formularioPolGral.addEventListener('submit', function (e)
{
    e.preventDefault();

    let nom_usua =document.getElementById("nombre_us");
    let nom_ser = document.getElementById("nom_servicio");
    if (document.getElementById("usuario").disabled == true) {
      alert("Por favor, seleccione un tipo de usuario que si tenga registros");
    } else if (document.getElementById("tipo_servicio").disabled == true){
        alert("Por favor, seleccione un tipo de servicio que si tenga registros");
    } else if (document.getElementById("nombre_us").disabled==true) {
      alert("No se han encontrado usuarios registrados");
    } else if (document.getElementById("nom_servicio").disabled==true) {
        alert("No se han encontrado servicios registrados");
    } else if (nom_usua.value==""){
      alert("Por favor, seleccione un usuario");
    }else if (nom_ser.value==""){
        alert("Por favor, seleccione un servicio");
    }

    var datos = new FormData(formulario);
    console.log('Seleccione');
    fetch('../../controller/administrativo/Registro_General_Polizas.php', {
        method: 'POST',
        body: datos
        
    })
        .then(res => res.json())
        .then(data =>
        {
            
            console.log(data);
            if (data[0] === 'Correcto') {
                alert("Registro exitoso");
                location.href = '../../view/administrativo/Reg_Polizas_Individual.html?idPol='+data[1];
            }
            
            else {
                alert(data);
            }
        })
})