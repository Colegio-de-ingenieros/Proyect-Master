var formulario = document.getElementById('formulario');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario);
    fetch('../../controller/administrativo/Modificar_Trabajadores.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data === 'exito') {
            const form= document.getElementById('formulario');
            form.reset();
            alert("Actualización exitosa");
            location.href = '../../view/administrativo/Vista_Trabajadores.html';
            
        }
        //los datos no pasaron alguna validacion
        else {
            alert("RFC ya existente");
        }
    })
})