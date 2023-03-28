<?php
    include_once('../../model/Reg_Cursos.php');

    $nombre_curso = $_POST['nombre_curso'];
    $clave_curso = $_POST['clave_curso'];
    $duracion = $_POST['duracion_curso'];
    $objetivo = $_POST['objetivo'];
    $lista1 = json_decode($_POST['temario']);

    $arrayin = array($clave_curso, $nombre_curso, $objetivo, $duracion);
    
    /* foreach ($lista1 as $lista) {
        foreach ($lista as $elemento) {
            echo $elemento . " "; 
        }
        echo "<br>";
    } */


?>