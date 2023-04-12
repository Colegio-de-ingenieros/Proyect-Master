<?php

require_once('../../model/administrativo/Reg_Seguimiento.php');
$objeto=new Seguimiento();
$data =[];

if(isset($_POST["tipo"])){
    $valTipo=$_POST["tipo"];
    //$data = [$radio];
    if ($valTipo=="curso"){
        $data = $objeto->buscar_cursos();
    }else if ($valTipo=="proyecto"){
        $data = $objeto->buscar_proyectos();
    }else{
        $data = $objeto->buscar_certificaciones();
    }

}

echo json_encode($data)

?>