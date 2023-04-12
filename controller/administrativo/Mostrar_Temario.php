<?php
include_once('../../model/Mostrar_Temario.php');

class Curso{
    public $id;
    public $titulo;
    public $subtitulos;

    public function __construct($id, $titulo, $subtitulos){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->subtitulos = $subtitulos;
    }
}
$lista = array();
$bd = new MostrarTemas();
$bd->BD();

$ids="000000";

$idtemasl = [];
$nomtemasl = [];


$datost = $bd->tema($ids);
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
        //$respuesta .= '<h3 style="width: 500px; word-wrap: break-word;">'.$nomtemasl[$i] .'</h3><br>';
        $titulo = $nomtemasl[$i];
        $id = $idtemasl[$i];
        $datoss = $bd->subtema($tem,((string)$idtemasl[$i]));
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
            $subtitulos = $nomsubtemasl;                   
        }
    }
    $curso = new Curso($id, $titulo, $subtitulos);
    array_push($lista, $curso); 
}
echo var_dump($lista);

