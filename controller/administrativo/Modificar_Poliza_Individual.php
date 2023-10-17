<?php
require_once("../../model/administrativo/Modificar_Poliza_Individual.php");
$objeto = new Modificar_Poliza_Individual();
$datos = "upps surgio un error";

if(isset($_POST["id_info"])){
    $id_poliza = $_POST["id_info"];
    $resultados = $objeto->datos_generales($id_poliza);
    $resultados2 = $objeto->polizas_individuales($id_poliza);
    $resultados3 = $objeto->propietario_poliza($id_poliza);

    $datos = array(
        "datos_generales" => $resultados,
        "polizas_individuales" => $resultados2,
        "propietario"=>$resultados3
    );



}else if(isset($_POST["id"]) && isset($_POST["polizas_in"])){
    $polizas_in = json_decode($_POST["polizas_in"]);

    $datos = $objeto->modificar_polizas($_POST["id"],$polizas_in);

}

header("Content-Type: application/json");
echo json_encode($datos);




/*
if($result == true){
    $nuevoNombre=$idPoliza;
    $target_path = "../comprobantes/administrativo/polizas/";
    $parts = explode(".",$_FILES['archivo']['name']);
    $target_path = $target_path . $nuevoNombre.".". end($parts);
    move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path);
    
    $data=('Gasto registrado exitosamente');
}
else{
    $data=('Ha ocurrido un error al conectar con la base de datos');
}

*/



?>

