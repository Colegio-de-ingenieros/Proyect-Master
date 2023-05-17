<?php
require_once('../../model/registro/Reg_Personal.php');
$objeto=new Personal();
$data=[];
if(isset($_POST["cpPerso"])){


    $data = $objeto->buscar_colonias($_POST["cpPerso"]);

}

echo json_encode($data);

?>