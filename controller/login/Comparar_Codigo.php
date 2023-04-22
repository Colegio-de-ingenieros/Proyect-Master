<?php

require_once("../../model/login/Sesiones.php");
session_start();
#este si no esta el usuario entonces no puede entrar
if(isset($_POST["sesion"])){
    $respuesta = [0,"../../view/login/recuperar_Contra1.html"];
    if(isset($_SESSION["email"])){
        $respuesta = [1,""];
        
    }
    header("Content-Type: application/json");
    echo json_encode($respuesta);
}
# este archivo compara el codigo que mando el usuario con el que tenemos 
# si son igual avanza
if(isset($_POST["codigo"])){
    $respuesta = [0,""];
    $codigo_mandado = intval($_POST["codigo"]);
    $codigo_real = intval($_SESSION["codigo"]);

    if(time() > $_SESSION["timeout"]){
        $respuesta = [0,"El código ya expiro"];
    }else if($codigo_mandado == $codigo_real){

        $_SESSION["codigo_correcto"] = true;

        $respuesta = [1,"../../view/login/recuperar_Contra3.html"];

    }else{
        $respuesta = [0,"El código es incorrecto"];
    }


    header("Content-Type: application/json");
    echo json_encode($respuesta);

}
// esta parte crea un nuevo codigo 
if(isset($_POST["nuevo_codigo"])){

    $user = new User();
    $codigo = mt_rand(10000, 99999);
    $_SESSION["codigo"] = $codigo;
    $_SESSION["timeout"] = time()+(60*30); # vence en 30 minutos
    $usuario = $_SESSION["email"];
    $user->correoConCodigo($usuario,$codigo);

    
}







?>