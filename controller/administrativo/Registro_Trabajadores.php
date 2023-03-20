<?php
include_once('../../model/Reg_Trabajadores.php');
$rfc = $_POST["caja_rfc"];
$nombre = $_POST["caja_nombre"];
$apaterno = $_POST["caja_ap_paterno"];
$amaterno = $_POST["caja_ap_materno"];
$correo = $_POST["caja_correo"];
$telefono = $_POST["caja_telefono"];
$pass = $_POST["caja_contra"];
$pass_hashed = password_hash($pass, PASSWORD_BCRYPT);
//$ban=true;
$obj = new NuevoTrabajador();
$obj->conexion();

if($obj->buscarPorRFC($rfc)){
    echo json_encode('ya existe');
}else{
    $obj->insertar($nombre, $apaterno, $amaterno, $rfc, $correo, $telefono, $pass_hashed);
    echo json_encode('exito');
    
}