<?php
include_once('../../model/administrativo/Eliminar_Cursos_Model.php');
ini_set('display_errors', 1);
$base = new EliminarCurso();

if(isset($_POST["id"])){
    

    $id = $_POST["id"];
    $estatus = $base->buscaestatus($id);
   
    $respuesta = [];

    if($estatus == 1){

        $respuesta = ["no hubo exito"];
    }
    else if ($estatus == 2){
        $respuesta = ["error por poliza"];
    }
    else{
        // busca si tiene temas
        $datost = $base->t($id);
        $respuesta = $datost;
        
        if(count($datost) > 0){//si tiene elemnetos que que entre
            
            $base->eliminarcursotema($id);
            $base->eliminarcurso($id);
            

            for ($i=0; $i < count($datost) ; $i++) { 
            
                $tema = $datost[$i]["IdTema"];
                $datoss = $base->s($tema);
                $base->eliminartemasub($datost[$i]["IdTema"]);
                $base->eliminartema($datost[$i]["IdTema"]);

                for ($j=0; $j < count($datoss) ; $j++) { 
                    $base->eliminarsubtema($datoss[$j]["IdSubT"]);
                }

            }
            $respuesta = $datost;


        }else{
            $base->eliminarcurso($id);

        }

        $respuesta = ["Exito"];
    }
    header("Content-Type: application/json");
    echo json_encode($respuesta);
}

?>