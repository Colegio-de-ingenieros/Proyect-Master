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
    $obj = new funciones_cv();
    $obj -> conexion();


    $ids_de_bolsacv = $obj -> seleccion_bolsa_cv($datos_generales[0]);
    $ids_de_xp_academica = $obj -> seleccion_xp_academica($datos_generales[0]);
    $ids_de_xp_profesional = $obj -> seleccion_xp_profesional($datos_generales[0]);

    if (isset($ids_de_bolsacv)){


        $obj->actualizarbolsa($ids_de_bolsacv[0]["IdBolCv"], $datos_generales[3], $datos_generales[1], $datos_generales[2]);
        for ($i=0; $i < count($ids_de_bolsacv); $i++) { 
           /*  $obj -> eliminar_persobolsa_cv($datos_generales[0]); */
            $obj -> eliminar_expaca_cv($ids_de_bolsacv[$i]["IdBolCv"]);
            $obj -> eliminar_exppro_cv($ids_de_bolsacv[$i]["IdBolCv"]);
           /*  $obj -> eliminar_bolsa_cv($ids_de_bolsacv[$i]["IdBolCv"]); */
        }
        if (isset($ids_de_xp_academica)){
            for ($i=0; $i < count($ids_de_xp_academica); $i++) { 
                $obj -> eliminar_expacademica($ids_de_xp_academica[$i]["IdExpAca"]);
            }
        }
        if (isset($ids_de_xp_profesional)){
            for ($i=0; $i < count($ids_de_xp_profesional); $i++) { 
                $obj -> eliminar_expprofesional($ids_de_xp_profesional[$i]["IdExpP"]);
            }
        }
        //llenar tabla experiencia academica
        $id_experiencia_academica = $obj -> buscarUltimoIdexpacademica();
        $id_experiencia_academica = $obj -> agregar_ceros($id_experiencia_academica, 6);

        for ($i=0; $i < count($experiencia_academica); $i++) { 
            $obj -> insertar_expaca($id_experiencia_academica, $experiencia_academica[$i][0], $experiencia_academica[$i][1]);
            $obj -> insertar_expacacv($id_experiencia_academica,$ids_de_bolsacv[0]["IdBolCv"]);

            $id_experiencia_academica = $obj -> buscarUltimoIdexpacademica();
            $id_experiencia_academica = $obj -> agregar_ceros($id_experiencia_academica, 6);
        }

        //llenar tabla experiencia profesional
        $id_experiencia_profesional = $obj ->buscarUltimoIdexpprofesional();
        $id_experiencia_profesional = $obj -> agregar_ceros($id_experiencia_profesional, 6);

        for ($i=0; $i < count($experiencia_profesional); $i++) { 
            $obj -> insertar_exppro($id_experiencia_profesional, $experiencia_profesional[$i][1], $experiencia_profesional[$i][2], $experiencia_profesional[$i][3], $experiencia_profesional[$i][0], $experiencia_profesional[$i][4]);
            $obj -> insertar_expprocv($id_experiencia_profesional,$ids_de_bolsacv[0]["IdBolCv"]);

            $id_experiencia_profesional = $obj ->buscarUltimoIdexpprofesional();
            $id_experiencia_profesional = $obj -> agregar_ceros($id_experiencia_profesional, 6);
        }
    }

    

/* else{
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

}
 */
    echo json_encode('Registro exitoso');
    /* echo json_encode($id_persobolsa); */
}
?>