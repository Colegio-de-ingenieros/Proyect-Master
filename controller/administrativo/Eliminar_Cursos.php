<?php
include_once('../../model/administrativo/Eliminar_Cursos.php');

$bd = new EliminarCurso();
$bd->BD();

$id = $_GET['id'];
$id = $bd->agregar_ceros($id, 6);

$estatus = $bd->buscaestatus($id);
/* $estacur= $estatus[0]["EstatusCur"]; */

if ($estatus == true) {
    http_response_code(404);
}
else{
$datost = $bd->t($id);
if ($datost) {
    $bd->eliminarcursotema($id);
    $bd->eliminarcurso($id);    
    for ($i = 0; $i < count($datost); $i++) {


        $tema =  $datost[$i]["IdTema"];
        $datoss = $bd->s($tema);
        $bd->eliminartemasub($datost[$i]["IdTema"]); 
        $bd->eliminartema($datost[$i]["IdTema"]);

            for ($j = 0; $j < count($datoss); $j++) {
                $bd->eliminarsubtema($datoss[$j]["IdSubT"]); 
            } 
    }
}


else {
    $bd->eliminarcurso($id);
}
echo json_encode("exito");
}
/* header("Location: ../../view/administrativo/Vista_Cursos.php"); */

