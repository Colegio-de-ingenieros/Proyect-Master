<?php
    include_once('../../model/Reg_Cursos.php');

    $nombre_curso = $_POST['nombre_curso'];
    $clave_curso = $_POST['clave_curso'];
    $duracion = $_POST['duracion_curso'];
    $objetivo = $_POST['objetivo'];
    $temario = json_decode($_POST['temario']);

    /* Imprime todas las variables */
    echo $nombre_curso;
    echo '<br>';
    echo $clave_curso;
    echo '<br>';
    echo $duracion;
    echo '<br>';
    echo $objetivo;
    echo '<br>';
    
    foreach ($temario as $lista) {
        foreach ($lista as $elemento) {
            echo $elemento . " ";
        }
        echo "<br>";
    }
    
?>