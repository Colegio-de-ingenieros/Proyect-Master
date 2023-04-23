<?php

require_once("../../model/administrativo/Mostrar_ReporteIn.php");

if(isset($_POST["tipo"])){

    $tipo = $_POST["tipo"];
    $reportes = new Reportes_in();

    if($tipo == "cursos"){

        $datos = $reportes->buscarCursos();


    }else if($tipo == "certificaciones"){

        $datos = $reportes->buscarCertificaciones();

    }else if($tipo == "proyectos"){

        $datos = $reportes->buscarProyectos();

    }

    header("Content-Type: application/json");
    echo json_encode($datos);
}



?>