<?php
include_once('../../model/administrativo/Mostrar_Cursos.php');

$respuesta = '';
$bd = new MostrarCurso();
$bd->BD();

if (isset($_POST['consulta'])) {
    $busqueda = $_POST['consulta'];

    if(empty($busqueda)){
       $respuesta = $bd->cursos_disponibles();         
    }else{
        $respuesta = $bd->buscar($busqueda);
    }   

    
}

header("Content-Type: application/json");
echo json_encode($respuesta);
?>
