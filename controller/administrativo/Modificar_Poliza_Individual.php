<?php
require_once("../../model/administrativo/Modificar_Poliza_Individual.php");
$objeto = new Modificar_Poliza_Individual();
$datos = "upps surgio un error";

if(isset($_POST["id_info"]) && isset($_POST["servicio_tipo"])){
    $id_poliza = $_POST["id_info"];
    $tipo = $_POST["servicio_tipo"];
    $resultados = $objeto->datos_generales($id_poliza);
    $resultados2 = $objeto->polizas_individuales($id_poliza);
    $resultados3 = $objeto->propietario_poliza($id_poliza);
    $resultados4 = $objeto->tipo_servicio($id_poliza,$tipo);

    $datos = array(
        "datos_generales" => $resultados,
        "polizas_individuales" => $resultados2,
        "propietario"=>$resultados3,
        "servicio"=>$resultados4

    );



}else if(isset($_POST["id"]) && isset($_POST["polizas_in"])){


    $polizas_in = json_decode($_POST["polizas_in"]);
    $path = "../comprobantes/administrativo/polizas/";
    $resultado_procesado = $objeto->modificar_polizas($_POST["id"],$polizas_in);

    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }

    if(count($resultado_procesado) == 0){
        $datos = false;

    }else{
       
        $index_files = 0;
        for ($i=0; $i < count($resultado_procesado) ; $i++) { 

            $poliza = $resultado_procesado[$i];
            
            
            if($poliza[0] == "new"){
                $file = $path.$poliza[1].".pdf";
                $tmpName = $_FILES['archivos']['tmp_name'][$index_files];
                move_uploaded_file($tmpName, $file);

                $index_files++;
    
            }else if($poliza[0] == "update"){
                $file = $path.$poliza[1].".pdf";
    
                if(file_exists($file)){
                    
                    unlink($file);
                    $tmpName = $_FILES['archivos']['tmp_name'][$index_files];
                    move_uploaded_file($tmpName, $file);
                }else{
                    $tmpName = $_FILES['archivos']['tmp_name'][$index_files];
                    move_uploaded_file($tmpName, $file);
                }
                $index_files++;
    
            }else{
                $file = $path.$poliza[1].".pdf";
                if(file_exists($file)){
                    unlink($file);
                }
            }
            
        }

        $datos = true;

    }

    
   
}

header("Content-Type: application/json");
echo json_encode($datos);

?>

