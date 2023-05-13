<?php

require_once("../../model/administrativo/Mostrar_ReporteIn.php");
$reportes = new Reportes_in();
if(isset($_POST["tipo"]) && isset($_POST["bandera"])){

    $tipo = $_POST["tipo"];

    if($tipo == "cursos"){

        $datos = $reportes->buscarCursos();


    }else if($tipo == "certificaciones"){

        $datos = $reportes->buscarCertificaciones();

    }else if($tipo == "proyectos"){

        $datos = $reportes->buscarProyectos();

    }

    header("Content-Type: application/json");
    echo json_encode($datos);

}else if(isset($_POST["numero_seguimiento"]) && isset($_POST["tipo_reporte"])){

    $numero_segumiento = $_POST["numero_seguimiento"];
    $tipo_reporte = $_POST["tipo_reporte"];
    $datos = [];
    $datos_seguimieto = [];

    if($tipo_reporte == "1"){
        $inicio = $_POST["inicio"];
        $fin = $_POST["fin"];
        $datos[] = $reportes->consultaSocioFecha($numero_segumiento,$inicio,$fin);
        $datos[] = $reportes->consultaEmpresaFecha($numero_segumiento,$inicio,$fin);
        $datos[] = $reportes->consultaInstructorFecha($numero_segumiento,$inicio,$fin);

        
    }else{
        
        $datos_seguimieto[] = $reportes->consultaSocio($numero_segumiento);
        $datos_seguimieto[] = $reportes->consultaEmpresa($numero_segumiento);
        $datos_seguimieto[] = $reportes->consultaInstructor($numero_segumiento);
        $datos[] = $reportes->periodoHistorico($numero_segumiento);
        $datos[] =  $datos_seguimieto;

    }

   


    header("Content-Type: application/json");
    echo json_encode($datos);

}


?>