<?php
//obtener el id
$rfc = $_GET["rfc"];

//llamar a los otros archivos que se ocupan
include_once('../../model/administrativo/Mostrar_Trabajadores.php');
include_once('../../view/administrativo/Modi_Trabajadores.html');
//instancias la clase para buscar y traer los datos
$base = new MostrarTrabajadores();
$base->instancias();
$resultado = $base->getTrabajadoresRFC($rfc);
//guardar los datos en variables
$nombre=$resultado[0]["NombreT"];
$ap_paterno=$resultado[0]["ApePT"];
$ap_materno=$resultado[0]["ApeMT"];
$correo=$resultado[0]["CorreoT"];
$telefono=$resultado[0]["TelT"];
//echo $nombre;
?>


<!-- script para poner los valores en los campos correspondientes -->
<script languaje="javascript">
    document.getElementById("caja_rfc").value = "<?php echo $rfc ?>";
    document.getElementById("caja_nombre").value = "<?php echo $nombre ?>";
    document.getElementById("caja_ap_paterno").value = "<?php echo $ap_paterno ?>";
    document.getElementById("caja_ap_materno").value = "<?php echo $ap_materno ?>";
    document.getElementById("caja_correo").value = "<?php echo $correo ?>";
    document.getElementById("caja_telefono").value = "<?php echo $telefono ?>";
</script>