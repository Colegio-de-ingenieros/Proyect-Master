<?php
include_once('../../model/administrativo/Mostar_Temario.php');

class Curso{
    public $id;
    public $title;
    public $subtitles;

    public function __construct($id, $titulo, $subtitulos){
        $this->id = $id;
        $this->title = $titulo;
        $this->subtitles = $subtitulos;
    }
}
$lista = array();
$bd = new MostrarTemas();
$bd->BD();

$idtemasl = [];
$nomtemasl = [];

$ids = $_POST['id_usuario'];

$todo = [];

$lgeneral=[];
$general = $bd->cursos($ids);

array_push($lgeneral, $general[0]["NomCur"]);
array_push($lgeneral, $general[0]["ClaveCur"]);
array_push($lgeneral, $general[0]["DuracionCur"]);
array_push($lgeneral, $general[0]["ObjCur"]);

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
    $subtitulo= [];
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
        $curso = new Curso($id, $titulo, $nomsubtemasl);
        array_push($lista, $curso); 
    }
    /* header('Content-Type: application/json'); */

    array_push($todo, $lgeneral);
    array_push($todo, $lista); 
    echo json_encode($todo); 
}
else {
    array_push($todo, $lgeneral);
    array_push($todo, []);
    echo json_encode($todo); 
}