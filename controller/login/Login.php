<?php
require_once("../../model/login/Sesiones.php");
session_start();
$respuesta = [0,""];
if(isset($_SESSION["token"]) && isset($_COOKIE["token"])){

    if($_SESSION["token"] == $_COOKIE["token"]){

        $tipo_usuario = $_SESSION["tipo_usuario"];

        if($tipo_usuario == "empresa"){
            $respuesta = [1,"../../view/empresa/Menu_empresa.html"];
        }else if($tipo_usuario == "socio"){
            $respuesta = [1,"../../view/socio-asociado/Menu_socio.html"];
        }else if($tipo_usuario == "trabajador"){
            $respuesta = [1,"../../view/administrativo/plantilla_menu_admin.html"];
        }

    }

}else{
    if(isset($_POST["usuario"]) && isset($_POST["password"])){

        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        
    
        $user = new User();
    
        if($user->userExist_empresa($usuario)){
    
            if($user->isPasswordCorrect_empresa($usuario,$password)){
               
                $token = sha1(uniqid(rand(),true));
                $_SESSION["token"] = $token;
                $_SESSION["tipo_usuario"] = "empresa";
                $_SESSION["usuario"] = $usuario;
                
                setcookie("token",$token,time()+(60*60*8),"/");
                
    
                $respuesta = [1,"../../view/empresa/Menu_empresa.html"];
                
            }else{
                $respuesta = [0,"Contraseña incorrecta"];
            }
    
        }else if($user->userExist_socio_asociado($usuario)){
    
            if($user->isPasswordCorrect_socio_asociado($usuario,$password)){
               
                $token = sha1(uniqid(rand(),true));
                $_SESSION["token"] = $token;
                $_SESSION["tipo_usuario"] = "socio";
                $_SESSION["usuario"] = $usuario;
               
                setcookie("token",$token,time()+(60*60*8),"/");
               
    
                $respuesta = [1,"../../view/socio-asociado/Menu_socio.html"];
            }else{
                $respuesta = [0,"Contraseña incorrecta"];
            }
    
        }else if($user->userExist_trabajadores($usuario)){
    
            if($user->isPasswordCorrect_trabajadores($usuario,$password)){
                
                $token = sha1(uniqid(rand(),true));
                $_SESSION["token"] = $token;
                $_SESSION["tipo_usuario"] = "trabajador";
                $_SESSION["usuario"] = $usuario;
                
                setcookie("token",$token,time()+(60*60*8),"/");
                
                $respuesta = [1,"../../view/administrativo/plantilla_menu_admin.html"];
            }else{
                $respuesta = [0,"Contraseña incorrecta"];
            }
    
        }else{
            $respuesta = [0,"El usuaio no existe"];
    
        }
    
    
        
    
    }
}

header("Content-Type: application/json");
echo json_encode($respuesta);





?>