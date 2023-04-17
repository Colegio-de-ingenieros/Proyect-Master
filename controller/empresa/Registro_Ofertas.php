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


//$ban=true;
$obj = new NuevaOferta();
$obj->conexion();
$anterior=$obj->obtenerId();
if ($anterior==null){
    $anterior="000000";
}
//$prueba="000001";
//echo intval($prueba);
//echo intval($anterior);
$num=intval($anterior)+1;
//echo $num;
$num=str_pad($num, 6, "0", STR_PAD_LEFT);
//echo $num;
$obj->insertar($num, $nomVac, $acaVac, $tecVac, $descVac, $expVac, $brutVac, $menVac, $hinVac, $hfinVac, $telVac, $calleVac, $corVac, $jorVac, $colVac, $modVac);    
//$obj->insertar($num, $nomVac, $acaVac, $tecVac, $descVac, $cpVac, $calleVac, $colVac, $modVac, $jorVac, $expVac, $brutVac, $menVac, $hinVac, $hfinVac, $telVac, $corVac );
//$obj->insertar_tipo("4,$rfc);
echo json_encode('exito');
/*include_once('../../model/empresa/Reg_Trabajadores.php');
$nomVac= "trabajador";
$acaVac = "Ingeniero";
$tecVac = "Que le sepa al excel";
$descVac = "Va a ser el IBM";
$cpVac = "99750";
$calleVac = "Lopez mateos #8";
$colVac = 320451644;
$modVac = 1;
$jorVac = 1;
$expVac = 2;
$brutVac = 200.50;
$menVac = 200;
$hinVac = "08:00";
$hfinVac = "16:00";
$telVac = "4371073134";
$corVac = "Lopez Mateos #8";
$num=1;
//$ban=true;
$obj = new NuevoTrabajador();
$obj->conexion();

 $obj->insertar($num, $nomVac, $acaVac, $tecVac, $descVac, $expVac, $brutVac, $menVac, $hinVac, $hfinVac, $telVac, $calleVac, $corVac, $jorVac);    
//$obj->insertar($num, $nomVac, $acaVac, $tecVac, $descVac, $cpVac, $calleVac, $colVac, $modVac, $jorVac, $expVac, $brutVac, $menVac, $hinVac, $hfinVac, $telVac, $corVac );
//$obj->insertar_tipo("4,$rfc);*/
    
