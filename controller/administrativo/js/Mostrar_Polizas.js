let tipo;
window.onload = () => {
  const ingreso = document.getElementById("radio_ingreso");
  const egreso = document.getElementById("egreso");
  tipo = "ingreso";
  ingreso.addEventListener("click", function () {
    tipo = "ingreso";
    buscar_datos(tipo);
  });

  egreso.addEventListener("click", function () {
    tipo = "egreso";
    buscar_datos(tipo);
  });

  const buscar_datos = (consulta) => {
    $.ajax({
        url: "../../controller/administrativo/Mostrar_Polizas.php",
        type: "POST",
        dataType: "html",
        data: { consulta: consulta, tipo: tipo },
      })
  
        .done(function (respuesta) {
          $("#tablaResultado").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
  };
  $(document).on('keyup', '#busqueda', function (){
    var valorBusqueda = $(this).val();
    console.log(valorBusqueda);
    if (valorBusqueda != "") {
        buscar_datos(valorBusqueda);
    } else {
        buscar_datos();
    }
})
};
