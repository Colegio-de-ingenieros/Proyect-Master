<?php
include_once('../../model/socio-asociado/Reg_CV.php');
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
        /* echo json_encode('Correcto'); */
        if (count($variable3) > 1 ){
            $FechaF2 = $variable3[1][3];
            $FechaI2 = $variable3[1][2];
                if ($FechaF2 > $FechaI2){
                    meterdatos($variable1,$variable2,$variable3);
                }
                else{
                    echo json_encode('Fechas2');
                }
            }
        else{
            meterdatos($variable1,$variable2,$variable3);
        }
    }
    else{
        echo json_encode('Fechas');
    }

function meterdatos($datos_generales,$experiencia_academica,$experiencia_profesional){

    /* echo json_encode('Correcto'); */

    $obj = new funciones_cv();
    $obj -> conexion();

    //llenar tabla bolsacv y su relacion con usuaperso
    $id_persobolsa = $obj -> buscarUltimoIdbolsacv();
    $id_persobolsa = $obj -> agregar_ceros($id_persobolsa, 6);

    $obj -> insertar_bolsacv($id_persobolsa, $datos_generales[3], $datos_generales[1], $datos_generales[2]);

    $obj -> insertar_persobolsa($datos_generales[0], $id_persobolsa);

    //llenar tabla experiencia academica
    $id_experiencia_academica = $obj -> buscarUltimoIdexpacademica();
    $id_experiencia_academica = $obj -> agregar_ceros($id_experiencia_academica, 6);

    for ($i=0; $i < count($experiencia_academica); $i++) { 
        $obj -> insertar_expaca($id_experiencia_academica, $experiencia_academica[$i][0], $experiencia_academica[$i][1]);
        $obj -> insertar_expacacv($id_experiencia_academica,$id_persobolsa);

        $id_experiencia_academica = $obj -> buscarUltimoIdexpacademica();
        $id_experiencia_academica = $obj -> agregar_ceros($id_experiencia_academica, 6);
    }

    //llenar tabla experiencia profesional
    $id_experiencia_profesional = $obj ->buscarUltimoIdexpprofesional();
    $id_experiencia_profesional = $obj -> agregar_ceros($id_experiencia_profesional, 6);

    for ($i=0; $i < count($experiencia_profesional); $i++) { 
        $obj -> insertar_exppro($id_experiencia_profesional, $experiencia_profesional[$i][1], $experiencia_profesional[$i][2], $experiencia_profesional[$i][3], $experiencia_profesional[$i][0], $experiencia_profesional[$i][4]);
        $obj -> insertar_expprocv($id_experiencia_profesional,$id_persobolsa);

        $id_experiencia_profesional = $obj ->buscarUltimoIdexpprofesional();
        $id_experiencia_profesional = $obj -> agregar_ceros($id_experiencia_profesional, 6);
    }

    echo json_encode('Datos insertados correctamente');
    /* echo json_encode($id_persobolsa); */
}
?>