<?php
include_once('../../model/administrativo/Mostrar_SocioAsoc.php');

$objeto=new Mostrar_SocioAsoc();

$data =[];
$idp=$_POST["idP"];

$datos = $objeto->get_datos($idp);
$dire=$objeto->get_direccion($idp);
$grado=$objeto->get_estudios($idp);
$labor=$objeto->get_laborales($idp);
$data=array_merge($datos,$dire,$grado,$labor);

echo json_encode($data);

?>