<?php
    include_once('../../model/administrativo/Instructores.php');

    $objeto = new Instructor_model();

    $instructores = $objeto->extraerInstructores();

?>