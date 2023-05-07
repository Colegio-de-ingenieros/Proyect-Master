//declara las variables globales
var formulario = document.getElementById('formula');


formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    
    var datos= new FormData(formulario);
    const valores = window.location.search;
    //console.log(valores);
    const urlParams = new URLSearchParams(valores);
    //Accedemos a los valores
    var producto = urlParams.get('id');
    
    cadena='../../controller/administrativo/Actualizacion_Comentario_Oferta.php?id='+producto;
    console.log(cadena);
    fetch(cadena, {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data === 'exito') {
            const form= document.getElementById('formulario');
            alert("Registro exitoso");
            
        }
    })
})
