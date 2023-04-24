<?php
    require_once("../../model/socio-asociado/Aplicar_Vacante.php");
    $id_bolsa = $_POST['id_bolsa'];
    $id_usuario = $_POST['id_usuario'];

    $objeto = new dato();
    $objeto->BD();
    
    $resultado = $objeto->IngresarRegistro($id_bolsa, $id_usuario);
    echo json_encode($resultado);
?>