
<?php
include_once('../../model/administrativo/Mostrar_SocioAsociado.php');
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

$base = new MostrarSocioAsociado();
$base->instancias();
if ($bandera==0){
    $base->modificar_curso($id,$comentario,$valorRadio);
    echo json_encode('exito');}
else{
    echo json_encode($id);}