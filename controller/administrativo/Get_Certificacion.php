<?php
$idc = $_GET["idc"];

include_once('../../model/Mostrar_Certificaciones.php');
include_once('../../view/administrativo/Modi_Certificaciones.html');

$base = new MostrarCertificaciones();
$base->instancias();
$resultado = $base->getCertificacionesId($idc);

$logo = $resultado[0]["LogoCerInt"];
$nombre = $resultado[0]["NomCertInt"];
$abre = $resultado[0]["abrevCertInt"];
$desc = $resultado[0]["DesCerInt"];
$status = $resultado[0]["EstatusCertInt"];
$precioG = $base->buscarUltimoPrecioG($idc);
$precioA = $base->buscarUltimoPrecioA($idc);

//echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="100" height="100">';

?>



<script languaje="javascript">
    document.getElementById("nombre").value = "<?php echo $nombre ?>";
    document.getElementById("abreviacion").value = "<?php echo $abre ?>";
    document.getElementById("descripcion").value = "<?php echo $desc ?>";
    document.getElementById("precioAsoc").value = "<?php echo $precioA ?>";
    document.getElementById("precioGen").value = "<?php echo $precioG ?>";

    const logoImg = document.createElement('img');
    logoImg.src = "<?php echo 'data:image/jpeg;base64,' . base64_encode($logo) ?>";
    logoImg.width = 100;
    logoImg.height = 100;
    const contenedor = document.getElementById('photo');
    contenedor.appendChild(logoImg);

    //document.getElementById("inputLogo").value = "<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="100" height="100">';?>";
</script>