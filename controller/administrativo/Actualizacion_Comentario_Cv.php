
<?php
include_once('../../model/administrativo/Modificar_Oferta.php');
$id=$_GET["id"];
$comentario = $_POST["descri_puesto"];
$valorRadio = $_POST["radiosb"];
$bandera=0;
if ($valorRadio == null){
    $bandera=1;
}
$obj = new ModOferta();
$obj->conexion();
if ($bandera==0){
    $obj->modificar_cv($id,$comentario,$valorRadio);
    echo json_encode('exito');}
else{
    echo json_encode($id);}

