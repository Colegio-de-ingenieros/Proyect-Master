//declara las variables globales
var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos = new FormData(formulario);
    //fusiona el html con el php de la logica y validaciones
    fetch('../../controller/administrativo/Registro_Certificaciones.php', {
        method: 'POST',
        body: datos
    })
        //recibe el mensaje para mandarlo como alerta
        .then(res => res.json())
        .then(data =>
        {
            //el registro fue exitoso
            if (data === 'todo chido') {
                alert("Registro exitoso");
                location.href = '../../view/administrativo/Reg_Certificaciones.html';
            }

            //los datos no pasaron alguna validacion
            else {
                alert(data);
            }
        })
})