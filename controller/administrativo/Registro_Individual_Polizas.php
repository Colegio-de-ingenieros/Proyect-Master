<?php
include_once('../../model/administrativo/Registro_Individual_Polizas.php');

$tabla = json_decode($_POST["tabla"]);


/* $obj = new Nuevapoliza();
$obj->conexion();

$resultados = $obj->id_individual();



$resultados = $resultados[0][0] + 1;
$resultados = $obj->agregar_ceros($resultados);

echo json_encode($resultados); */

foreach ($tabla as $fila) {
    if ($fila != "n/a"){
        $concepto = $fila[0];
        $monto = $fila[1];
        $concepto_pdf = $fila[2];
        $tipo = $fila[4];
        $id_general = "0001";
        echo $concepto . " " . $monto . " " . $concepto_pdf . " " . $id_general . " " . $tipo ."<br>";

    }
}


/* $targetDir = dirname(__FILE__) . "/pdfs/";
$arreglo = json_decode($_POST["archivo"]);
var_dump($arreglo); */


/*     foreach ($tabla as $archivo) {
        $nombreArchivo = $archivo[3]; // El índice 3 contiene el nombre del archivo PDF
        $rutaArchivoTemp = $_FILES["archivo"]["tmp_name"];

        // Comprueba si el archivo existe en la ubicación temporal
        if (file_exists($rutaArchivoTemp)) {
            $newTargetFile = $targetDir . str_replace('.tmp', '.pdf', $nombreArchivo);

            // Intenta mover el archivo temporal a la ubicación final
            if (rename($rutaArchivoTemp, $newTargetFile)) {
                echo "El archivo " . $nombreArchivo . " se copió correctamente.<br>";
            } else {
                echo "Error al copiar el archivo " . $nombreArchivo . ".<br>";
            }
        } else {
            echo "El archivo temporal " . $nombreArchivo . " no se encontró.<br>";
        
    
} 
    }
 */
?>