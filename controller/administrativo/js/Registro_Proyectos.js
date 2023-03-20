//declara las variables globales
var formulario = document.getElementById('formulario');


//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    
    console.log('me diste click');
    var datos = new FormData(formulario);
    console.log(datos.get('nom_proyecto'));
    console.log(datos.get('obj_proyecto'));
    //Une el html con el php de la logica y validaciones
    fetch('../../controller/administrativo/Registro_Proyectos.php', {
        method: 'POST',
        body: datos
        
    })
 
        .then(res => res.json())
        .then(data =>
        {
                        
            console.log(data);
            if (data === 'Correcto') {
                alert("Registro exitoso");
            }

            else {
                alert("ERROR");
            }
        })
})