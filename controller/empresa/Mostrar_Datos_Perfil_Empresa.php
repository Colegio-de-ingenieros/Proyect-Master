<?php
require_once("../../model/empresa/Mostrar_Datos_Perfil_Empresa.php");
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


$objeto = new Mostrar_perfil_empresa();
$datos = [];


if(isset($_SESSION["usuario"])){

    $correo = $_SESSION["usuario"];
    
    $datos = $objeto->obtener_datos($correo);

}
header("Content-Type: application/json");
echo json_encode($datos);


?>