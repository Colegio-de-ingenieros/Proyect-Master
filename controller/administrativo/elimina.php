<?php
include_once('../../model/administrativo/Eliminar_Cursos.php');

$bd = new EliminarCurso();
$bd->BD();

$id = $_GET['id'];

$estatus = $bd->buscaestatus($id);

if ($estatus == 1) {
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

