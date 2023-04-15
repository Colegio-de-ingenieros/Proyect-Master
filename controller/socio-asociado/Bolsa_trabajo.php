<?php
    include_once('../../model/socio-asociado/Bolsa_trabajo.php');

    $obj = new funciones_bolsa();
    $obj -> conexion();

    $resultados = $obj -> extraer_datos_bolsa();
    if ($resultados != "No se encontraron resultados"){
        $array = array();
        /* Guarda los valores en un arreglo */
        for ($i=0; $i < count($resultados); $i++) {
            $array[$i] = $resultados[$i];
        }
        header('Content-Type: application/json');
        echo json_encode($array);
    }
    else{
        echo $resultados;
    }
?>