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
   $c2 = 2;
}
if (isset($_POST['c3'])) {
   $c3 = 3;
}
if (isset($_POST['c4'])) {
   $c4 = 4;
}
if (isset($_POST['c5'])) {
   $c5 = 5;
}
if (isset($_POST['c6'])) {
   $c6 = 6;
}
if (isset($_POST['c7'])) {
   $c7 = 7;
}

session_start();
$username = $_SESSION['usuario'];
if ($c1 == 0 && $c2 == 0 && $c3 == 0 && $c4 == 0 && $c5 == 0 && $c6 == 0 && $c7 == 0) {
    echo json_encode('error');
}
else{

   $obj = new NuevaOferta();
   $obj->conexion();
   $rfccorreo1=$obj->rfccorreo($username);

   $rfce=$rfccorreo1[0][0];
 
   $anterior=$obj->obtenerId();
   if ($anterior==null){
      $anterior="000000";
   }
   $num=intval($anterior)+1;
   $num=str_pad($num, 6, "0", STR_PAD_LEFT);
   $obj->insertar($num, $nomVac, $acaVac, $tecVac, $descVac, $expVac, $brutVac, $menVac, $hinVac, $hfinVac, $telVac, $calleVac, $corVac, $jorVac, $colVac, $modVac,$c1, $c2, $c3, $c4, $c5, $c6, $c7,$rfce);    

   echo json_encode('exito');
}
    
