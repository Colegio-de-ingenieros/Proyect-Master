var formulario = document.getElementById('formula');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    console.log('me diste click');
    var datos= new FormData(formulario);

    //console.log(datos.get('caja_telefono'));
    //console.log(datos.get('caja_contra'));
    fetch('../../controller/empresa/Registro_Ofertas.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data === 'exito') {
            const form= document.getElementById('formula');
            form.reset();
            alert("Registro exitoso");
            
        }
        //los datos no pasaron alguna validacion
        else {
            alert("Error al registrar");
        }
    })
})