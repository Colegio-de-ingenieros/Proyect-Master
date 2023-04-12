<?php
//obtener el id
$idc = $_GET["idc"];

//llamar a los otros archivos que se ocupan
include_once('../../model/Mostrar_Certificaciones.php');
include_once('../../view/administrativo/Modi_Certificaciones.html');

//instancias la clase para buscar y traer los datos
$base = new MostrarCertificaciones();
$base->instancias();
$resultado = $base->getCertificacionesId($idc);

//guardar los datos en variables
$logo = $resultado[0]["LogoCerInt"];
$nombre = $resultado[0]["NomCertInt"];
$abre = $resultado[0]["abrevCertInt"];
$desc = $resultado[0]["DesCerInt"];
$status = $resultado[0]["EstatusCertInt"];
$precioG = $base->buscarUltimoPrecioG($idc);
$precioA = $base->buscarUltimoPrecioA($idc);

//echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="100" height="100">';

?>


<!-- script para poner los valores en los campos correspondientes -->
<script languaje="javascript">
    document.getElementById("idc").value = "<?php echo $idc ?>";
    document.getElementById("nombre").value = "<?php echo $nombre ?>";
    document.getElementById("abreviacion").value = "<?php echo $abre ?>";
    document.getElementById("descripcion").value = "<?php echo $desc ?>";
    document.getElementById("precioAsoc").value = "<?php echo $precioA ?>";
    document.getElementById("precioGen").value = "<?php echo $precioG ?>";

    const imagen = document.getElementById("logoActual");
    imagen.src = " <?php echo 'data:image/jpeg;base64,' . base64_encode($logo) ?>";
</script>