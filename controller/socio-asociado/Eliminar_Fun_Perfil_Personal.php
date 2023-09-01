<?php
include_once('../../model/socio-asociado/Modificar_Datos_Perfil_Personal.php');
$idV = $_GET["idc"];
$obj = new modificarDatosPerfilPersonal();
$obj->eliminar_func($idV);

/*echo "<script>location.href = '../../view/socio-asociado/Ver_Cursos.html';</script>";*/

?>