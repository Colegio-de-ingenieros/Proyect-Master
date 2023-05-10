<?php
    include_once('../../model/administrativo/Instructores.php');

    $objeto = new Instructor_model();
    $id = $_POST['id_instructor'];
    //? Id de prueba:  $id = 'I00006';

    $eliminar_instructor = $objeto->eliminar_instructor($id);
    
    echo json_encode($eliminar_instructor);
?>