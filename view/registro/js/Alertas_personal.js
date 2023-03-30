//declara las variables globales
var formulario = document.getElementById('formulario');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();

    let aviso_privacidad = document.getElementById("avisos1");
    let pasantia1 = document.getElementById("pasantia1");
    let pasantia2 = document.getElementById("pasantia2");
    let antecedente1 = document.getElementById("antecedente1");
    let antecedente2 = document.getElementById("antecedente2");
    let veridico1 = document.getElementById("veridico1");
    let veridico2 = document.getElementById("veridico2");
    let fecha_inicio = document.getElementById("fechaICert").value;
    let fecha_fin = document.getElementById("fechaFCert").value;
    let certificaciones = document.getElementById("checkboxcertificacion");
    let laborales = document.getElementById("checkboxlaboral");
    console.log("hola", fecha_inicio, "hola");
    let bandera = true

    if (certificaciones.checked){
        console.log("mundo")
        if (fecha_inicio!="" && fecha_fin!=""){
            if(Date.parse(fecha_inicio)>Date.parse(fecha_fin)){
                bandera=false
                alert("La fecha de finalización debe ser posterior a la fecha de inicio");
            }else{
                bandera=true
            }
        }
    }

    if (bandera==true){
        if(pasantia1.checked==false && pasantia2.checked==false){
            alert(" Para continuar con el registro, debe seleccionar la pasantía");
        }else if(antecedente1.checked==false && antecedente2.checked==false){
            alert("Para continuar con el registro, debe seleccionar antecedentes");
        }else if(veridico1.checked==false && veridico2.checked==false){
            alert("Para continuar con el registro, debe seleccionar datos veridicos");
        }else if(aviso_privacidad.checked == false){
            alert("Para continuar con el registro, debe aceptar el aviso de privacidad");
        }else{
    
            var datos= new FormData(formulario);
            fetch('../../controller/registro/Registro_Personal.php', {
                method: 'POST',
                body: datos
            })
    
            .then(res => res.json())
            .then(data => {
                if (data === 'exito') {
                    alert("Verifique su correo y guarde el número inteligente que le ha sido enviado.");
                    location.href="../../view/registro/Reg_Personal.html";
                }
                //los datos no pasaron alguna validacion
                else if (data === 'no exito'){
                    alert("Hubo un error");
                }
            })
        }
    }
    
})