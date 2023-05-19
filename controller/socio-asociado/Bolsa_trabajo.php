<?php
    include_once('../../model/socio-asociado/Bolsa_trabajo.php');

    $obj = new funciones_bolsa();
    $obj -> conexion();

    $resultados = $obj -> extraer_datos_bolsa();
    if ($resultados != "No se encontraron resultados"){
        $array = array();
        $ids = array();
        /* Extrae el id de cada vacante */
        for ($i=0; $i < count($resultados); $i++) { 
            $id = $resultados[$i]['IdEmpBol'];
            $ids[$i] = $id;
        }  

        /* Extrae los dias laborales de cada vacante */
        $array_dias_laborales = array();
        for ($i=0; $i < count($ids); $i++) { 
            $id = $ids[$i];
            $dias_laborales = $obj -> extraer_dias_laborales($id);
            $array_dias_laborales[$i] = $dias_laborales;
        }

        /* Añade cada elemento de días laborales a cada elemento de resultados */
        for ($i=0; $i < count($resultados); $i++) { 
            $resultados[$i][19] = $array_dias_laborales[$i];
        }

        /* Guarda los valores en un arreglo */
        for ($i=0; $i < count($resultados); $i++) {
            $array[$i] = $resultados[$i];
        }


        header('Content-Type: application/json');
        echo json_encode($array);
    }
    else{
        header('Content-Type: application/json');
        echo json_encode($resultados);
    }
?>