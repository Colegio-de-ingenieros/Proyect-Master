//declara las variables globales
var formulario = document.getElementById('formulario');


formulario.addEventListener('submit', function (e)
{
    e.preventDefault();

    var datos= new FormData(formulario);

    fetch('../../controller/administrativo/Registro_Trabajadores.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data === 'exito') {
            const form= document.getElementById('formulario');
            form.reset();
            alert("Registro exitoso");
            
        }
        else if (data === 'correo') {
            alert("Este correo ya esta registrado");
        }
        else {
            alert("RFC ya existente");
        }
    })
})
