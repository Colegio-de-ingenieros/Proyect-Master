<?php
    include_once('../../model/administrativo/Eliminar_Instructores.php');

    $objeto = new Eliminar_Instructor_model();
    $id = $_POST['id_instructor'];
    //? Id de prueba:  $id = 'I00001';

    $eliminar_instructor = $objeto->eliminar_instructor($id);
    
    echo json_encode($eliminar_instructor);
?>