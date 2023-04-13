<?php
include_once('../../model/administrativo/Modificar_Trabajadores.php');
$rfc = $_POST["caja_rfc"];
$nombre = $_POST["caja_nombre"];
$apaterno = $_POST["caja_ap_paterno"];
$amaterno = $_POST["caja_ap_materno"];
$correo = $_POST["caja_correo"];
$telefono = $_POST["caja_telefono"];
$ban=true;
$obj = new ModTrabajador();
$obj->conexion();
$obj->modificar($rfc,$nombre,$apaterno,$amaterno,$correo,$telefono);
echo json_encode('exito');
?>