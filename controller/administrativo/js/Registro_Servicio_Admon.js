//declara las variables globales
var formulario = document.getElementById('formula');


formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario);
    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    var producto = urlParams.get('id');
    
    cadena='../../controller/administrativo/Actualizacion_Servicio_Admon.php?id='+producto;
    //console.log(cadena);
    fetch(cadena, {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        //console.log(data);
        if (data === 'exito') {
            const form= document.getElementById('formulario');
            alert("Envío exitoso");
            location.href = '../../view/administrativo/Vista_Servicios.html';
        }
        else{
            console.log(data);
        }
    }) 
})