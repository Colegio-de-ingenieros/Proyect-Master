var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');

formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos = new FormData(formulario);
    fetch('../../controller/administrativo/Modificar_Proyectos.php', {
        method: 'POST',
        body: datos
    })

        .then(res => res.json())
        .then(data =>
        {
        
            if (data === 'Correcto') {
                alert("Actualización exitosa");
                location.href = '../../view/administrativo/Vista_Proyectos.php';
            }

            else {
                alert("Error al acutualizar el proyecto");
            }
        })
})