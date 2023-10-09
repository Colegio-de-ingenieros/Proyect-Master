<?php
$tabla = json_decode($_POST["tabla"]);
$targetDir = dirname(__FILE__) . "/pdfs/";
$arreglo = json_decode($_POST["archivo"]);
var_dump($arreglo);


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


echo json_encode($arreglo);
?>