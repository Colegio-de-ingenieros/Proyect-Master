<?php
include_once('../../model/empresa/Reg_Ofertas.php');
$nomVac= $_POST["nom_vacante"];
$acaVac = $_POST["requi_academicos"];
$tecVac = $_POST["requi_tecnicos"];
$descVac = $_POST["descri_puesto"];
$cpVac = $_POST["cpPerso"];
$calleVac = $_POST["calle"];
$colVac = $_POST["colonia"];
$modVac = $_POST["forma_trabajo"];
$jorVac = $_POST["jornada_laboral"];
$expVac = $_POST["experiencia_lab"];
$brutVac = $_POST["sal_bruto"];
$menVac = $_POST["sal_mensual"];
$hinVac = $_POST["inicio"];
$hfinVac = $_POST["final"];
$telVac = $_POST["caja_telefono"];
$corVac = $_POST["caja_correo"];
$active = []; 
$c1=0;
$c2=0;
$c3=0;
$c4=0;
$c5=0;
$c6=0;
$c7=0;
if (isset($_POST['c1'])) {
   $c1 = 1;
}
if (isset($_POST['c2'])) {
   $c2 = 1;
}
if (isset($_POST['c3'])) {
   $c3 = 1;
}
if (isset($_POST['c4'])) {
   $c4 = 1;
}
if (isset($_POST['c5'])) {
   $c5 = 1;
}
if (isset($_POST['c6'])) {
   $c6 = 1;
}
if (isset($_POST['c7'])) {
   $c7 = 1;
}

//$ban=true;
$obj = new NuevaOferta();
$obj->conexion();
$anterior=$obj->obtenerId();
if ($anterior==null){
    $anterior="000000";
}
$num=intval($anterior)+1;
$num=str_pad($num, 6, "0", STR_PAD_LEFT);
$obj->insertar($num, $nomVac, $acaVac, $tecVac, $descVac, $expVac, $brutVac, $menVac, $hinVac, $hfinVac, $telVac, $calleVac, $corVac, $jorVac, $colVac, $modVac);    

echo json_encode('exito');

    
