<?php
require_once("../../model/socio-asociado/Bolsa_Trabajo2.php");
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $objeto = new dato();
    $objeto->BD();
    $datos = $objeto->usuario($tipo_usuario,$usuario);

    header("Content-Type: application/json");
    echo json_encode($datos);
}
?>