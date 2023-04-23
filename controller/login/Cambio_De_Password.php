<?php
# cambia la contraseña de un usuario
require_once("../../model/login/Sesiones.php");
session_start();
if(isset($_POST["sesion"])){

    $respuesta = [0,"../../view/login/recuperar_Contra1.html"];

    if(isset($_SESSION["email"]) && isset($_SESSION["codigo_correcto"])){

        $respuesta = [1,""];

    }if(isset($_SESSION["email"]) && isset($_SESSION["codigo_correcto"]) == false){

        session_destroy();
        $respuesta = [0,"../../view/login/recuperar_Contra1.html"];

    }

    header("Content-Type: application/json");
    echo json_encode($respuesta);
}
if(isset($_POST["password"]) && isset($_POST["password_confirmacion"])){

    $respuesta = false;
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $usuario = $_SESSION["email"];
    $user = new User();
    $tipo_usuario = $_SESSION["tipo_usuario"];

    if($tipo_usuario == "empresa"){

        $respuesta = $user->cambioContra_empresa($usuario,$password);

    }else if($tipo_usuario == "socio"){

        $respuesta = $user->cambioContra_socio_asociado($usuario,$password);

    }if($tipo_usuario == "trabajador"){

        $respuesta = $user->cambioContra_trabajadores($usuario,$password);
    }

    if($respuesta){

        $direccion = ["../../view/login/recuperar_Contra4.html"];

    }else{

        $direccion = [""];

    }
    
    session_destroy();

    header("Content-Type: application/json");
    echo json_encode($direccion);
}






?>