<?php
include_once('../../model/socio-asociado/Eliminar_Cursos.php');
$idc = $_GET["idc"];
$obj = new eliminarCursos();
$obj->eliminar($idc);

/*echo "<script>location.href = '../../view/socio-asociado/Ver_Cursos.html';</script>";*/

?>