<?php
    require_once("../../model/empresa/Mostrar_Servicios.php");
    $id = $_POST['id'];

    $objeto = new Mostrar_Servicios();
    $objeto -> BD();

    $cancelar_servicio = $objeto -> cancelar_servicio($id);

    echo json_encode($cancelar_servicio);
?>