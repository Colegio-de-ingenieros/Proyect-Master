<?php
$rfc = $_POST["caja_rfc"];
$nombre = $_POST["caja_nombre"];
$apaterno = $_POST["caja_ap_paterno"];
$amaterno = $_POST["caja_ap_materno"];
$correo = $_POST["caja_correo"];
$telefono = $_POST["caja_telefono"];
$pass = $_POST["caja_contra"];
var_dump();
if ($nombre == '' || $apaterno == '')
{
    echo json_encode('llena los campos');
}else{
    //
    echo json_encode('exito');
    
}