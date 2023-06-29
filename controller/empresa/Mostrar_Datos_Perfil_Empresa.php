<?php
require_once("../../model/empresa/Mostrar_Datos_Perfil_Empresa.php");

$objeto = new Mostrar_perfil_empresa();
$datos = [];
session_start();

if(isset($_SESSION["usuario"])){

    $correo = $_SESSION["usuario"];
    
    $datos = $objeto->obtener_datos($correo);

}
header("Content-Type: application/json");
echo json_encode($datos);


?>
