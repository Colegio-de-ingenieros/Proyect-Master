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
            const select = document.getElementById("colonia");
                    for (let i = select.options.length; i >= 0; i--) {
                      select.remove(i);
                    }
                select.appendChild(new Option("Seleccione su colonia", ""));
            alert("Registro exitoso");
            
        }
        //los datos no pasaron alguna validacion
        else {
            doNothing();
        }
    })
})