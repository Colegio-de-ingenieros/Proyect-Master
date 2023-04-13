<?php
include_once('../../model/Eliminar_Cursos.php');

$bd = new EliminarCurso();
$bd->BD();

$id = $_GET['id'];

$idtemasl = [];
$nomtemasl = [];

$idsubtemasl = [];
$nomsubtemasl = [];

$datost = $bd->t($id);
if ($datost) {
    for ($i = 0; $i < count($datost); $i++) {
        $tem = $datost[$i]["NomTema"];
        $iden = $datost[$i]["IdTema"];

        array_push($idtemasl, ((int)$iden));
        array_push($nomtemasl, $tem);
    }

    for ($i = 0; $i < count($idtemasl); $i++) {
        for ($j = 0; $j < count($idtemasl); $j++) {
            if ($idtemasl[$i] < $idtemasl[$j]) {
                $aux = $idtemasl[$i];
                $aux1 = $nomtemasl[$i];
                $nomtemasl[$i] = $nomtemasl[$j];
                $idtemasl[$i] = $idtemasl[$j];
                $idtemasl[$j] = $aux;
                $nomtemasl[$j] = $aux1;
            }
        }
    }

    for ($i = 0; $i < count($idtemasl); $i++) {
        $datoss = $bd->s($tem,((string)$idtemasl[$i]));
        $idsubtemasl = [];
        $nomsubtemasl = [];
        if ($datoss) {

            for ($j = 0; $j < count($datoss); $j++) {
                $te = $datoss[$j]["NomSubT"];
                $idss = $datoss[$j]["IdSubT"]; 
                array_push($idsubtemasl, ((int)$idss));
                array_push($nomsubtemasl, $te);
            }

            for ($is = 0; $is < count($idsubtemasl); $is++) {
                for ($js = 0; $js < count($idsubtemasl); $js++) {
                    if ($idsubtemasl[$is] < $idsubtemasl[$js]) {
                        $aux = $idsubtemasl[$is];
                        $aux1 = $nomsubtemasl[$is];
                        $nomsubtemasl[$is] = $nomsubtemasl[$js];
                        $idsubtemasl[$is] = $idsubtemasl[$js];
                        $idsubtemasl[$js] = $aux;
                        $nomsubtemasl[$js] = $aux1;
                    }
                }
            }          
        }
    }
    $bd->eliminarcursotema($id);
    $bd->eliminarcurso($id);
    if ($idtemasl) {
        for ($p = 0; $p < count($idtemasl); $p++) {
            $bd->eliminartemasub($idtemasl[$p]);
            $bd->eliminartema($idtemasl[$p]); 
        }
    }
    if ($idsubtemasl) {
        for ($p = 0; $p < count($idsubtemasl); $p++) {
            $bd->eliminarsubtema($idsubtemasl[$p]); 
        }
    }
}
else {
    $bd->eliminarcurso($id);
}

header("Location: ../../view/administrativo/Vista_Cursos.php");