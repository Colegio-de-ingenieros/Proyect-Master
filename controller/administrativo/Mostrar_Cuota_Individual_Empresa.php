<?php
$id=$_GET['id'];
include_once('../../model/administrativo/Mostrar_Empresa.php');
include_once('../../view/administrativo//Aprobacion_Cuotasempresa.html');
$base = new MostrarEmpresa();
$base->instancias();
$resultado = $base->buscar_datos($id);
if ($resultado == true) {
    $monto = $resultado[0]["MontoVigCuo"];
    $tipo = $resultado[0]["TipoCuota"];
    $fecha_inicio = $resultado[0]["IniVigCuo"];
    $fecha_fin = $resultado[0]["FinVigCuo"];
    $estatus = $resultado[0]["EstatusVigCuo"];
    $comentario = $resultado[0]["ComeVigCuo"];
}

?>
<script languaje="javascript">
</script>
<script>
    <?php if ($estatus==1 or $estatus==0) { ?>
        // Marcar el checkbox si la condición en PHP se cumple
        var textBox = document.getElementById("descri_puesto");
        document.getElementById("ti_ck1").checked = true;
        textBox.disabled = true;
    <?php }else if ($estatus==2){ ?>
        document.getElementById("ti_ck2").checked = true;
        var textBox = document.getElementById("descri_puesto");
        textBox.disabled = false;
        var texto ="<?php echo $comentario; ?>";
        textBox.value = texto;
    <?php } ?>
</script>
<script languaje="javascript">
  var parrafo = document.getElementById("tipoCUOTASOCIO"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $tipo; ?>"; // modificamos su contenido

  var parrafo = document.getElementById("montoCUOTASOCIO"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $monto; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("fechainicioCUOTASOCIO"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $fecha_inicio; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("fechafinalCUOTASOCIO"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $fecha_fin; ?>";
var parrafo = document.createElement("p");
const linkElement = document.getElementById("link_com");
linkElement.href = "../../controller/Comprobantes/empresa/cuotas/<?php echo $id; ?>";
</script>
