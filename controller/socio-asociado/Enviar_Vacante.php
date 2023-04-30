<?php
    require_once("../../model/socio-asociado/Aplicar_Vacante.php");
    $id_bolsa = $_POST['id_bolsa'];
    $id_usuario = $_POST['id_usuario'];

    $objeto = new dato();
    $objeto->BD();

    $existencia = $objeto->verificarExistenciaRegistro($id_bolsa, $id_usuario);
    $existencia = $existencia[0][0];

    if($existencia == 1){
        $mensaje = "Ya has aplicado a esta vacante";
        echo json_encode($mensaje);
    }
    else if($existencia == 0){
        $resultado = $objeto->IngresarRegistro($id_bolsa, $id_usuario);
        echo json_encode($resultado);
    }
?>