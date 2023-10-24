window.onload = function () { 
    let tipoUsua =document.getElementById("usuario").value;
    let tipoSer =document.getElementById("tipo_servicio").value;
    console.log(tipoUsua, tipoSer)
    obtenerUsuarios(tipoUsua)
    obtenerServicios(tipoSer)
  }

formularioPolGral.usuario.addEventListener("change", (e) => {
    let tipoUsua =document.getElementById("usuario").value;
    obtenerUsuarios(tipoUsua)
})

formularioPolGral.tipo_servicio.addEventListener("change", (e) => {
    let tipoSer =document.getElementById("tipo_servicio").value;
    obtenerServicios(tipoSer)
})

function obtenerServicios(tipoSer){
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
}
  
function obtenerUsuarios(tipoUsua){
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
            console.log(data.length);
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
        });
}

var formulario = document.getElementById('formularioPolGral');

formularioPolGral.addEventListener('submit', function (e){
    e.preventDefault();
    if (document.getElementById("nombre_us").disabled == true) {
      alert("Por favor, seleccione un tipo de usuario que si tenga registros");
    } else if (document.getElementById("nom_servicio").disabled == true){
        alert("Por favor, seleccione un tipo de servicio que si tenga registros");
    } else{
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
                    alert("Primera parte del registro completada");
                    location.href = '../../view/administrativo/Reg_Polizas_Individual.html?idPol='+data[1];
                }
                
                else {
                    alert(data);
                }
            })
    }
})