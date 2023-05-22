var formulario = document.getElementById('formularioProyectos');
var respuesta = document.getElementById('respuesta');

formularioProyectos.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos = new FormData(formulario);
    fetch('../../controller/administrativo/Registro_Proyectos.php', {
        method: 'POST',
        body: datos
    })
        .then(res => res.json())
        .then(data =>
        {
            if (data === 'Correcto') {
                alert("Registro exitoso");
                location.href = '../../view/administrativo/Reg_Proyectos.html';
            }
            
            else if (data === 'Fechas') {
                alert("Fecha de finalización debe ser posterior a fecha de inicio");
            }
            else {
                alert(data);
            }
        })
})