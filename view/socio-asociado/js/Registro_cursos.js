//declara las variables globales
var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario);
    fetch('../../controller/socio-asociado/Registro_Cursos.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Registro exitoso.");
            location.href="../../view/socio-asociado/Reg_Cursos.html";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else{
            alert (data)
        }
    })
})