<?php
require_once('../../model/empresa/Reg_Ofertas.php');
$objeto=new NuevaOferta();
$objeto->conexion();
$data=[];
$data = $objeto->llenarJornada();
echo json_encode($data);

?>