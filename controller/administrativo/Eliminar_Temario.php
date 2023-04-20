<?php
include_once('../../model/administrativo/Modificar_Temario.php');


// Leemos el arreglo enviado desde JavaScript
$arreglo = json_decode($_POST["arrayin"]);

// Leemos la lista 1 enviada desde JavaScript
$lista1 = json_decode($_POST["lista"]);
$id = $_POST['id'];
/* echo $id;
var_dump($lista1);
var_dump($arreglo); */
$obj = new NuevoCurso();
$obj->conexion();

	 
$id = $_POST['id'];
$id = str_replace('"', '', $id);

$idtemasl = [];
$nomtemasl = [];

$idsubtemasl = [];
$nomsubtemasl = [];


$datost = $obj->t($id);
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
        $datoss = $obj->s($tem,((string)$idtemasl[$i]));
        
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
    $obj->eliminarcursotema($id);
    $obj->eliminarcurso($id);
    if ($idtemasl) {
        for ($p = 0; $p < count($idtemasl); $p++) {
            $obj->eliminartemasub($idtemasl[$p]);
            $obj->eliminartema($idtemasl[$p]); 
        }
    }
    if ($idsubtemasl) {
        for ($p = 0; $p < count($idsubtemasl); $p++) {
            $obj->eliminarsubtema($idsubtemasl[$p]); 
        }
    }
}
else {
    $obj->eliminarcurso($id);
}



	
$obj->insertar($arreglo);
$longi=[];

for ($i=0;$i<count($lista1);$i++){
    array_push($longi,$lista1[$i]);
}

$incres=$obj->idsub();
$incres=$incres[0][0];
$incres++;



$incre=$obj->idtema();
$incre=$incre[0][0];
$incre = $incre+$incres;
$incre++;

$tema = [];

for($i=0;$i<count($lista1);$i++){
    $obj->insertarTema($incre,$lista1[$i][0]);
    array_push($tema,$incre);
    $incre++;
}



for($i=0;$i<count($tema);$i++){
    $obj->curtem($arreglo[0],$tema[$i]);
}



for($i=0;$i<count($lista1);$i++){
    if ($longi[$i] > 1){
        for($j=1;$j<count($lista1[$i]);$j++){
            $obj->insertarSub($incres,$lista1[$i][$j]);
            $obj->temsub($tema[$i],$incres);
            $incres = $incres+1;
        }
    }
}



