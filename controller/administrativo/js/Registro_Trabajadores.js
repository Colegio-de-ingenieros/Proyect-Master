//declara las variables globales
var formulario = document.getElementById('formulario');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    console.log('me diste click');
    var datos= new FormData(formulario);

    console.log(datos.get('caja_telefono'));
    console.log(datos.get('caja_contra'));
    fetch('../../controller/administrativo/Registro_Trabajadores.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data === 'exito') {
            alert("Registro exitoso");
        }
        //los datos no pasaron alguna validacion
        else {
            alert("RFC ya existente");
        }
    })
})
