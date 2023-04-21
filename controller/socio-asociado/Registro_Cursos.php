<?php

require_once('../../model/socio-asociado/Reg_Cursos.php');
$objeto=new Cursos();

$id_curso=$objeto->id_cursos();
$nombre=$_POST["nombre"];
$organizacion=$_POST["organizacion"];
$horas=$_POST["totalhoras"];
$archivo=$_FILES["archivo"]["name"];

$u=$objeto->insertar_cursos($id_curso, $nombre, $organizacion, $horas, $archivo);

if ($u==true){
    echo json_encode('exito');
}else{
    echo json_encode('no exito');
}
?>