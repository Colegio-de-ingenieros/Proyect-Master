<?php
/**
 * procesa los datos y hace la consulta
 */
require_once("../model/Alta_empresa.php");
if(
    isset($_POST["rfc"]) &&
    isset($_POST["nombre"]) &&
    isset($_POST["correo"]) &&
    isset($_POST["password"]) &&
    isset($_POST["password_confirmacion"]) &&
    isset($_POST["razon"])
){
    $rfc = $_POST["rfc"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $pass = $_POST["password"];
    $pass_con = $_POST["password_confirmacion"];
    $razon = $_POST["razon"];
    

    $alta = new Alta_empresa();
  
}

?>