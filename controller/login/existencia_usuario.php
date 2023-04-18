<?php
require_once("../../model/login/sesiones.php");

if(isset($_POST["usuario"])){
    $usuario = $_POST["usuario"];
    $user = new User();

    if($user->userExist_empresa($usuario)){
    
        session_start();   
        $codigo = mt_rand(10000, 99999);
       
        $_SESSION["tipo_usuario"] = "empresa";
        $_SESSION["email"] = $usuario;
        $_SESSION["codigo"] = $codigo;
        $_SESSION["timeout"] = time()+(60*30);
        $respuesta = [1];
        
        $user->correoConCodigo($usuario,$codigo);

        $respuesta = [1,"../../view/login/recuperar_Contra2.html"];
    
        

    }else if($user->userExist_socio_asociado($usuario)){

        session_start();  
        $codigo = mt_rand(10000, 99999);
     
        $_SESSION["tipo_usuario"] = "socio";
        $_SESSION["email"] = $usuario;
        $_SESSION["codigo"] = $codigo;
        $_SESSION["timeout"] = time()+(60*30);
        
        $user->correoConCodigo($usuario,$codigo);

        $respuesta = [1,"../../view/login/recuperar_Contra2.html"];

    }else if($user->userExist_trabajadores($usuario)){
        
        session_start();  
        $codigo = mt_rand(10000, 99999);

        $_SESSION["tipo_usuario"] = "trabajador";
        $_SESSION["email"] = $usuario;
        $_SESSION["codigo"] = $codigo;
        $_SESSION["timeout"] = time()+(60*30);
        
        $user->correoConCodigo($usuario,$codigo);
        $respuesta = [1,"../../view/login/recuperar_Contra2.html"];

    }else{
        $respuesta = [0];

    }
    header("Content-Type: application/json");
    echo json_encode($respuesta);
}

?>