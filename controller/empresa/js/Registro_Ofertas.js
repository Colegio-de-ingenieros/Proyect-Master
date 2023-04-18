var formulario = document.getElementById('formula');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario);

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