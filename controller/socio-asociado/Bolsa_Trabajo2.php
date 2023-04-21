<?php
require_once("../../model/socio-asociado/Bolsa_Trabajo2.php");
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $objeto = new dato();
    $objeto->BD();
    $datos_personales = $objeto->usuario($tipo_usuario,$usuario);

    $id = $datos_personales[0]['IdPerso'];
    
    $datos_de_lugar = $objeto->lugar($id);
    $datos_de_certificaciones = $objeto->certificaciones($id);

    $datos_auxiliar = array_merge($datos_personales,$datos_de_lugar);
    $datos = array_merge($datos_auxiliar,$datos_de_certificaciones);

    header("Content-Type: application/json");
    echo json_encode($datos);
}
?>