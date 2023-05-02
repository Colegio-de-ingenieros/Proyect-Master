<?php
include_once('../../model/administrativo/Eliminar_Cursos.php');

$bd = new EliminarCurso();
$bd->BD();

if(isset($_POST["id"])){
    

    $id = $_POST["id"];
    $estatus = $bd->buscaestatus($id);

    $respuesta = [];

    if($estatus == 1){

        $respuesta = ["no hubo exito"];
      

    }else{
        // busca si tiene temas
        $datost = $bd->t($id);
        
        if(count($datost) > 0){//si tiene elemnetos que que entre
            
            $bd->eliminarcursotema($id);
            $bd->eliminarcurso($id);
            

            for ($i=0; $i < count($datost) ; $i++) { 
            
                $tema = $datost[$i]["IdTema"];
                $datoss = $bd->s($tema);
                $bd->eliminartemasub($datost[$i]["IdTema"]);
                $bd->eliminartema($datost[$i]["IdTema"]);

                for ($j=0; $j < count($datoss) ; $j++) { 
                    $bd->eliminarsubtema($datoss[$j]["IdSubT"]);
                }

            }

        }else{
            $bd->eliminarcurso($id);

        }

        $respuesta = ["Exito"];
    }

    header("Content-Type: application/json");
    echo json_encode($respuesta);

}

?>