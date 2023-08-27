<?php
require_once("../../model/empresa/Modificar_Datos_Perfil_Empresa.php");
require_once("../../model/login/Sesiones.php");

$user = new User();
$objeto = new Modificar_perfil_empresa();
$respuesta = "Ocurrio un error" ;
session_start();

if(isset($_SESSION["usuario"])){

    $correo = $_SESSION["usuario"];
    
    $rfc_anterior = $objeto->buscar_rfc_empresa($correo);
   

    if(isset($_POST["rfc"]) && isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["razon"])){
        
        $correo_nuevo = $_POST["correo"];

        if(strcmp($correo,$correo_nuevo) == 0){

            
            $res = $objeto->set_datos_generales($rfc_anterior,$_POST["nombre"],$correo_nuevo,$_POST["razon"]);
            if($res){
                $respuesta = "Actualización exitosa";
            }

        }else if($objeto->existeCorreo($correo_nuevo) == false){
            $res = $objeto->set_datos_generales($rfc_anterior,$_POST["nombre"],$correo_nuevo,$_POST["razon"]);
            if($res){
                $respuesta = "Actualización exitosa";
                $_SESSION["usuario"] = $correo_nuevo;
            }
            
        }else {
            $respuesta = "El correo electrónico ya ha sido registrado anteriormente.";
        }

        

    }else if(isset($_POST["password"]) && isset($_POST["password_confirmacion"]) && isset($_POST["password_actual"])){

        $password = $_POST["password_actual"];
        if($user->isPasswordCorrect_empresa($correo,$password)){
            
            $res = $objeto->set_password_nueva($rfc_anterior,$_POST["password"]);
            if($res){
                $respuesta = "Actualización exitosa";
            }

        }else{
            $respuesta = "La contraseña actual es incorrecta";
        }



    }else if(isset($_POST["codigo_postal"]) && isset($_POST["calle"]) && isset($_POST["colonia"])){
        $res = $objeto->set_domicilio($rfc_anterior,$_POST["calle"],$_POST["colonia"]);
        if($res){
            $respuesta = "Actualización exitosa";
        }
    }else if(isset($_POST["inicio"]) && isset($_POST["fin"]) && isset($_POST["dias"])){
        $res = $objeto->set_horario($rfc_anterior,$_POST["dias"],$_POST["inicio"],$_POST["fin"]);
        if($res){
            $respuesta = "Actualización exitosa";
        }
    }else if(isset($_POST["id"]) && isset($_POST["rh_nombre"]) && isset($_POST["rh_paterno"]) && isset($_POST["rh_materno"]) &&
            isset($_POST["rh_tele"]) && isset($_POST["rh_exten"]) && isset($_POST["rh_correo"])){
        // si quiere actualizar
        $res = $objeto->actualizar_area($_POST["id"],$_POST["rh_nombre"],$_POST["rh_paterno"],$_POST["rh_materno"],$_POST["rh_tele"],
                                        $_POST["rh_exten"],$_POST["rh_correo"]);
        if($res){
            $respuesta = ["Actualización exitosa"];
        }

    }else  if(isset($_POST["tipo"]) && isset($_POST["rh_nombre"]) && isset($_POST["rh_paterno"]) && isset($_POST["rh_materno"]) &&
            isset($_POST["rh_tele"]) && isset($_POST["rh_exten"]) && isset($_POST["rh_correo"])){
        // si quiere insertar un area de rh
        $res = $objeto->insertar_area("1",$rfc_anterior,$_POST["rh_nombre"],$_POST["rh_paterno"],$_POST["rh_materno"],$_POST["rh_tele"],
                                        $_POST["rh_exten"],$_POST["rh_correo"]);
        if($res[0]){
            $respuesta = ["Actualización exitosa", $res[1]];
        }

    }else if(isset($_POST["id"]) && isset($_POST["ti_nombre"]) && isset($_POST["ti_paterno"]) && isset($_POST["ti_materno"]) &&
            isset($_POST["ti_tele"]) && isset($_POST["ti_exten"]) && isset($_POST["ti_correo"])){
        // si quiere actualizar
        $res = $objeto->actualizar_area($_POST["id"],$_POST["ti_nombre"],$_POST["ti_paterno"],$_POST["ti_materno"],$_POST["ti_tele"],
                                        $_POST["ti_exten"],$_POST["ti_correo"]);
        if($res){
            $respuesta = ["Actualización exitosa"];
        }

        }else  if(isset($_POST["ti_nombre"]) && isset($_POST["ti_paterno"]) && isset($_POST["ti_materno"]) &&
            isset($_POST["ti_tele"]) && isset($_POST["ti_exten"]) && isset($_POST["ti_correo"])){

        // si quiere insertar un area de it
        $res = $objeto->insertar_area("2",$rfc_anterior,$_POST["ti_nombre"],$_POST["ti_paterno"],$_POST["ti_materno"],$_POST["ti_tele"],
                                        $_POST["ti_exten"],$_POST["ti_correo"]);
        if($res[0]){
            $respuesta = ["Actualización exitosa", $res[1]];
        }
    }else if(isset($_POST["id"]) && isset($_POST["ac_nombre"]) && isset($_POST["ac_paterno"]) && isset($_POST["ac_materno"]) &&
            isset($_POST["ac_tele"]) && isset($_POST["ac_exten"]) && isset($_POST["ac_correo"])){
            // si quiere actualizar
            $res = $objeto->actualizar_area($_POST["id"],$_POST["ac_nombre"],$_POST["ac_paterno"],$_POST["ac_materno"],$_POST["ac_tele"],
                                            $_POST["ac_exten"],$_POST["ac_correo"]);
            if($res){
                $respuesta = ["Actualización exitosa"];
            }

            }else  if(isset($_POST["ac_nombre"]) && isset($_POST["ac_paterno"]) && isset($_POST["ac_materno"]) &&
                isset($_POST["ac_tele"]) && isset($_POST["ac_exten"]) && isset($_POST["ac_correo"])){
            // si quiere insertar un area de ac o capacitacion
            $res = $objeto->insertar_area("3",$rfc_anterior,$_POST["ac_nombre"],$_POST["ac_paterno"],$_POST["ac_materno"],$_POST["ac_tele"],
                                            $_POST["ac_exten"],$_POST["ac_correo"]);
            if($res[0]){
                $respuesta = ["Actualización exitosa", $res[1]];
            }


    } else if(isset($_POST["id"]) && isset($_POST["tipo"])){
        # si quiere eliminar un area
        $res = $objeto->eliminar_area($rfc_anterior,$_POST["id"],$_POST["tipo"]);
        if($res){
            $respuesta = "Eliminado con éxito";
        }
    }else if(isset($_POST["acuerdo"])){
        $res = $objeto->set_acuerdo($rfc_anterior,$_POST["acuerdo"]);
        if($res){
            $respuesta = "Actualización exitosa";
        }

    }




}
header("Content-Type: application/json");
echo json_encode($respuesta);


?>