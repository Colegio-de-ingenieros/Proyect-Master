<?php

session_start();

$respuesta = [1];

if(!isset($_SESSION["token"]) || 
   !isset($_COOKIE["token"]) ){

    $respuesta = [0];

}else{

    if($_COOKIE["token"] != $_SESSION["token"] ||
    $_POST["acceso_a"] != $_SESSION["tipo_usuario"]){
        
        $respuesta = [0];
    }

}

header("Content-Type: application/json");
echo json_encode($respuesta);


?>