<?php
require_once('../../model/Reg_personal.php');
$objeto=new Personal();
$data=[];
if(isset($_POST["cpPerso"])){


    $data = $objeto->buscar_colonias($_POST["cpPerso"]);

}

echo json_encode($data);

?>