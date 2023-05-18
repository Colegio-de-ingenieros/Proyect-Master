
<?php
include_once('../../model/administrativo/Modificar_Oferta.php');
$id=$_GET["id"];

    
  
$valorRadio = $_POST["radiosb"];
$bandera=0;
if ($valorRadio == null){
    $bandera=1;
}
$comentario="";
if ($valorRadio==2){
    $comentario = $_POST["descri_puesto"];
}

$obj = new ModOferta();
$obj->conexion();
if ($bandera==0){
    $obj->modificar($id,$comentario,$valorRadio);
    echo json_encode('exito');}
else{
    echo json_encode($id);}

