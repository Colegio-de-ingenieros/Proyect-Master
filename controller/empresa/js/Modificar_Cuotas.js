
//declara las variables globales
var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos = new FormData(formulario);
    //fusiona el html con el php de la logica y validaciones
    fetch('../../controller/empresa/Modificar_Cuotas.php', {
        method: 'POST',
        body: datos
    })
        //recibe el mensaje para mandarlo como alerta
        .then(res => res.json())
        .then(data =>
        {
            //el registro fue exitoso
            if (data === 'exito') {
                alert("Actualización exitosa");
                location.href = '../../view/empresa/Vista_Cuotas.html';
            }
            //los datos no pasaron alguna validacion
            else if (data === 'no exito'){
                alert("Hubo un error");
            }
            //los datos no pasaron alguna validacion
            else {
                alert(data);
            }
        })
})