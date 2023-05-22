var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();

    var datos= new FormData(formulario);
    fetch('../../controller/socio-asociado/Registro_Cuotas.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Registro exitoso");
            location.href="../../view/socio-asociado/Reg_Cuota.html";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'No hubo éxito al registrar la cuota'){
            alert("Hubo un error");
        }
        else if (data == 'fechas'){
            alert("Fecha de finalización debe ser posterior a fecha de inicio");
        }
        else{
            alert (data)
        }
    })
})