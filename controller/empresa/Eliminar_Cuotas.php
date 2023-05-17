<?php
include_once('../../model/empresa/Eliminar_Cuotas.php');
$idV = $_GET["idc"];
$obj = new eliminarCuotas();
$obj->eliminar($idV);

/*echo "<script>location.href = '../../view/socio-asociado/Ver_Cursos.html';</script>";*/

?>