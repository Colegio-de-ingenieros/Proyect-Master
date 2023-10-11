<?php
include_once('../../model/administrativo/Registro_Individual_Polizas.php');

$tabla = json_decode($_POST["tabla"]);
$id_general = json_decode($_POST["id_general"]);
$id_general = $id_general[0];
$obj = new Nuevapoliza();
$obj->conexion();

for ($i = 0; $i < count($tabla); $i++) {
    if ($tabla[$i] != "n/a"){
        $resultados = $obj->id_individual();
        $resultados = $resultados[0][0]+1;
        $resultados = $obj->agregar_ceros($resultados);

        $concepto = $tabla[$i][0];
        $monto = $tabla[$i][1];
        $concepto_pdf = $tabla[$i][2];
        $tipo = $tabla[$i][4];
        $resultados = $obj->insertar($resultados, $concepto, $monto, $concepto_pdf, $tipo, $id_general);
    }
}
echo json_encode("exito");
?>