let nombrecurso = document.getElementById("busqueda");
nombrecurso.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;


    nombrecurso.value = valorInput
    console.log(nombrecurso.value)
    const bus = nombrecurso.value;
    /* let url = `http://localhost:3000/administrativo/busqueda_curso/${nombrecurso.value}` */
   if (nombrecurso.value != "") {
    $.ajax({
        url: '../../controller/administrativo/Mostrar_Cursos.php',
        type: 'POST',
        dataType: 'html',
        data: { busca: bus },
    })

        .done(function (respuesta)
        {
            $("#tablaResultado").html(respuesta);
        }
        )


}})
