<?php
include_once('../../model/administrativo/Registro_Individual_Polizas.php');

$obj = new Nuevapoliza();
$obj->conexion();
$contador = $obj->id_individual();


if ( isset($_FILES['pdfs'])) {
    $uploadDirectory = 'uploads/'; // Carpeta de destino para los PDFs

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    foreach ($_FILES['pdfs']['tmp_name'] as $key => $tmpName) {
        $fileName = $_FILES['pdfs']['name'][$key];
        $uploadPath = $uploadDirectory . $fileName;
        
        if (move_uploaded_file($tmpName, $uploadPath)) {
            // Los archivos se han cargado correctamente
            echo "El archivo '$fileName' se ha guardado con éxito en el servidor.";
        } else {
            // Hubo un error al guardar el archivo
            echo "Hubo un problema al guardar el archivo '$fileName' en el servidor.";
        }
        
    }
}
$tabla = json_decode($_POST["tabla"]);
$id_general = json_decode($_POST["id_general"]);
$id_general = $id_general[0];

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