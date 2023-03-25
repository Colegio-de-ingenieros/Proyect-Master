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


    if(Date.parse(fecha_inicio)>Date.parse(fecha_fin)){
        alert("La fecha de inicio tiene que ser menor que la fecha final");
    }else if(pasantia1.checked==false && pasantia2.checked==false){
        alert("Antes debe seleccionar la pasantia");
    }else if(antecedente1.checked==false && antecedente2.checked==false){
        alert("Antes debe seleccionar antecedentes");
    }else if(veridico1.checked==false && veridico2.checked==false){
        alert("Antes debe seleccionar datos veridicos");
    }else if(aviso_privacidad.checked == false){
        alert("Antes debe aceptar el aviso de privacidad");
    }

    if (Date.parse(fecha_inicio)<Date.parse(fecha_fin) && aviso_privacidad.checked && (pasantia1.checked || pasantia2.checked) && (antecedente1.checked || antecedente2.checked) && (veridico1.checked || veridico2.checked)) {
         /** extraemos los datos del formulario */


        var datos= new FormData(formulario);
        fetch('../../controller/registro/Registro_Personal.php', {
            method: 'POST',
            body: datos
        })

        .then(res => res.json())
        .then(data => {
            if (data === 'exito') {
                alert("Registro exitoso, se te ha enviado un correo electrónico con un número inteligente");
                location.href="../../view/registro/Reg_Personal.html";
            }else if (data === 'numeros'){
                alert("La contraseña debe contener números");
            }else if (data === 'mayusculas'){
                alert("La contraseña debe contener mayúsculas y minúsculas");
            }else if (data === 'caracteres'){
                alert("La contraseña debe tener al menos un carácter especial");
            }else if (data === 'coincidencia'){
                alert("La contraseña y la confirmación no coinciden");
            }
            //los datos no pasaron alguna validacion
            else if (data === 'no exito'){
                alert("Hubo un error");
            }
        })
    }
})