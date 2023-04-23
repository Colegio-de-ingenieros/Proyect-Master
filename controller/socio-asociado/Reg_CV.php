<?php
    /* include_once('../../model/socio-asociado/Reg_CV.php');

    $id = $_POST['id'];
    $obj = new funciones_cv();
    $obj -> conexion();

    $resultados = $obj -> extraer_datos_usuario($id);

    if ($resultados != "No se encontraron resultados"){
        $array = array();
       
        for ($i=0; $i < count($resultados); $i++) {
            $array[$i] = $resultados[$i];
        }

        echo json_encode($array);
    }
    else{
        echo $resultados;
    } */

    $variable1 = json_decode($_POST['datos_generales']);
    $variable2 = json_decode($_POST['experiencia_academica_general']);
    $variable3 = json_decode($_POST['experiencia_profesional_general']);

/*     var_dump($variable1);
    var_dump($variable2);
    var_dump($variable3); */

    $FechaF = $variable3[0][3];
    $FechaI = $variable3[0][2];

    if ($FechaF > $FechaI){
        echo json_encode('Correcto');
    }
    else{
        echo json_encode('Fechas');
    }


?>