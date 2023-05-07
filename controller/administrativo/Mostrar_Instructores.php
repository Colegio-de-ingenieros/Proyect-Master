<?php
    include_once('../../model/administrativo/Instructores.php');

    $objeto = new Instructor_model();

    $instructores = $objeto->extraerInstructores();

    $lista_instructores = [];
    foreach ($instructores as $element) {
        $lista_instructores[] = [
            $element['ClaveIns'],
            $element['NomIns'],
            $element['ApePIns'],
            $element['ApeMIns'],
            $element['EstatusIns']
        ];
    }

    echo json_encode($lista_instructores);
?>