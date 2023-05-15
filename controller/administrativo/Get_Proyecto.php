<?php
include_once('../../model/administrativo/Mostrar_Proyectos.php');

$objeto=new MostrarProyectos();
$objeto->instancias();
$data =[];
$idp=$_POST["idP"];
$data = $objeto->getProyectosId($idp);

echo json_encode($data);

?>
