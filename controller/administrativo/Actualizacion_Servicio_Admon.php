<?php
include_once('../../model/administrativo/Modificar_Servicio_Admon.php');
$id=$_GET["id"];

    
  
$valorRadio = $_POST["radiosb"];
$bandera=0;
if ($valorRadio == null){
    $bandera=1;
}


$obj = new ModSer();
$obj->conexion();
$res2 = $obj->outplacement($id);
$res = $obj->headhunter($id);

if ($res == true){
    /* $obj->modificar($id,$valorRadio);
    echo json_encode('exito');} */
    $valor = $res[0]["IdSer"];
    $obj->modificar($valor,$valorRadio);
    echo json_encode('exito');
}
else if ($res2==true){
    $valor = $res2[0]["IdSer"];
    $obj->modificar($valor,$valorRadio);
    echo json_encode('exito');
}
else{
    echo json_encode($id);} 
?>