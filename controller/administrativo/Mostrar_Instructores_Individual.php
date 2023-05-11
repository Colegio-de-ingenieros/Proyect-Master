<?php
    include_once('../../model/administrativo/Instructores.php');

    $objeto = new Instructor_model();

    $id = $_POST['id_instructor'];
    //? Id de prueba:  $id = 'I00001';
    
    $Info_Instructor_Individual = $objeto->mostrar_instructor_individual($id);

    $lista_datos_generales = [];
    $lista_especialidades = [];
    $lista_certificaciones_internas = [];
    $lista_certificaciones_externas = [];

    //* Extraemos la información básica individual del instructor
    foreach ($Info_Instructor_Individual['datos_basicos'] as $element) {
        $lista_datos_generales[] = [
            $element['NomIns'],
            $element['ApePIns'],
            $element['ApeMIns']
        ];
    }

    //* Extraemos las especialidades del instructor
    foreach ($Info_Instructor_Individual['especialidades'] as $element) {
        $lista_especialidades[] = [
            $element['NomEspIns']
        ];
    }

    //* Extraemos las certificaciones internas del instructor
    foreach ($Info_Instructor_Individual['certificaciones_internas'] as $element) {
        $lista_certificaciones_internas[] = [
            $element['NomCertInt'],
            $element['DesCerInt'],
            $element['EstatusCertInt']
        ];
    }

    //* Extraemos las certificaciones externas del instructor
    foreach ($Info_Instructor_Individual['certificaciones_externas'] as $element) {
        $lista_certificaciones_externas[] = [
            $element['NomCerExt'],
            $element['OrgCerExt'],
            $element['IniCerExt'],
            $element['FinCerExt']
        ];
    }

    //* Junta todas las variables en un solo arreglo y retornalo
    $resultados = [
        "datos_generales"=>$lista_datos_generales,
        "especialidades"=>$lista_especialidades,
        "certificaciones_internas"=>$lista_certificaciones_internas,
        "certificaciones_externas"=>$lista_certificaciones_externas
    ];

    echo json_encode($resultados);
?>