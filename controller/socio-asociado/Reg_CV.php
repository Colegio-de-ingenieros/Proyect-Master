<?php
    include_once('../../model/socio-asociado/Reg_CV.php');

    $id = $_POST['id'];
    $obj = new funciones_cv();
    $obj -> conexion();

    $resultados = $obj -> extraer_datos_usuario($id);

    if ($resultados != "No se encontraron resultados"){
        $array = array();
        /* Guarda los valores en un arreglo */
        for ($i=0; $i < count($resultados); $i++) {
            $array[$i] = $resultados[$i];
        }

        echo json_encode($array);
    }
    else{
        echo $resultados;
    }


?>