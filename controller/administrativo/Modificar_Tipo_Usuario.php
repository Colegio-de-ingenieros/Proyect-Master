<?php

require_once('../../model/administrativo/Modificar_Tipo_Usuario.php');
$objeto=new Tipo_Usuario();

$data =[];
$tipo=$_POST["tipo"];
$idP=$_POST["idP"];

//El usuario es asociado
if ($tipo=='asociado'){
    $valor=1;
}else{
    $valor=2;
}

$result = $objeto->modificar_tipo_usua($idP, $valor);

if($result == true){
    $data=('Envío exitoso');
}
else{
    $data=('Ha ocurrido un error al conectar con la base de datos');
}


echo json_encode($data);


?>