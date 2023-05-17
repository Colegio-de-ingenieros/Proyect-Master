<?php
require_once("../../model/administrativo/Modificar_Instructores.php");
$objeto = new  Modificar_Instructor();
/**para que pueda usar el array que me esta mandando */
$datos = "upps surgio un error";

if(isset($_POST["id"]) && isset($_POST["certificaciones"]) && isset($_POST["especialidades"]) && 
    isset($_POST["nombre"]) && isset($_POST["apellido_p"]) && 
    isset($_POST["apellido_m"]) && isset($_POST["cert_int"]) ){
        
    $especialidades = json_decode($_POST["especialidades"]);
    $certificacionesExternas = json_decode($_POST["certificaciones"]);

    $certificacionesInternas = $_POST["cert_int"];
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido_p = $_POST["apellido_p"];
    $apellido_m = $_POST["apellido_m"];

    if($certificacionesInternas == ""){
        $datos = $objeto->modificarinstructor($id,$nombre,$apellido_p,$apellido_m,$certificacionesExternas,$especialidades,array());

    }else{
        $datos = $objeto->modificarinstructor($id,$nombre,$apellido_p,$apellido_m,$certificacionesExternas,$especialidades,$certificacionesInternas);
    }

        
    

}else if(isset($_POST['id'])){
    $datos = $objeto->mostrarInstructorParaModificacion($_POST['id']);
}

header("Content-Type: application/json");
echo json_encode($datos);




?>