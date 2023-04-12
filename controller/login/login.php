<?php
require_once("../../model/login/sesiones.php");

if(isset($_POST["usuario"]) && isset($_POST["password"])){

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $respuesta = [0,""];

    $user = new User();

    if($user->userExist_empresa($usuario)){

        if($user->isPasswordCorrect_empresa($usuario,$password)){
            session_start();
            $token = sha1(uniqid(rand(),true));
            $_SESSION["token"] = $token;
            setcookie("token",$token,time()+(60*60*8),"/");
            setcookie("tipo_usuario","empresa",time()+(60*60*8),"/");

            $respuesta = [1,"../../view/empresa/plantilla_menu.html"];
            
        }else{
            $respuesta = [0,"Contraseña incorrecta"];
        }

    }else if($user->userExist_socio_asociado($usuario)){

        if($user->isPasswordCorrect_socio_asociado($usuario,$password)){
            session_start();
            $token = sha1(uniqid(rand(),true));
            $_SESSION["token"] = $token;
            setcookie("token",$token,time()+(60*60*8),"/");
            setcookie("tipo_usuario","socio",time()+(60*60*8),"/");

            $respuesta = [1,"../../view/socio-asociado/plantilla_menu.html"];
        }else{
            $respuesta = [0,"Contraseña incorrecta"];
        }

    }else if($user->userExist_trabajadores($usuario)){

        if($user->isPasswordCorrect_trabajadores($usuario,$password)){
            session_start();
            $token = sha1(uniqid(rand(),true));
            $_SESSION["token"] = $token;
            setcookie("token",$token,time()+(60*60*8),"/");
            setcookie("tipo_usuario","trabajador",time()+(60*60*8),"/");
            $respuesta = [1,"../../view/registro/Reg_Personal.html"];
        }else{
            $respuesta = [0,"Contraseña incorrecta"];
        }

    }else{
        $respuesta = [0,"El usuaio no existe"];

    }


    header("Content-Type: application/json");
    echo json_encode($respuesta);

}






?>