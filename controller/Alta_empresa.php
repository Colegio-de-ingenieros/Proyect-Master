<?php
/**
 * procesa los datos y hace la consulta
 */
require_once("../model/Alta_empresa.php");
$objeto = new Alta_empresa();
$data =[];
if(
    isset($_POST["rfc"]) &&
    isset($_POST["nombre"]) &&
    isset($_POST["correo"]) &&
    isset($_POST["password"]) &&
    isset($_POST["password_confirmacion"]) &&
    isset($_POST["razon"]) &&
    isset($_POST["codigo_postal"])&&
    isset($_POST["calle"]) &&
    isset($_POST["colonia"]) &&
    isset($_POST["ciudad"]) &&
    isset($_POST["estado"]) &&
    isset($_POST["dias"]) &&
    isset($_POST["inicio"]) &&
    isset($_POST["fin"])  &&
    isset($_POST["rh_nombre"]) &&
    isset($_POST["rh_paterno"]) &&
    isset($_POST["rh_materno"]) &&
    isset($_POST["rh_tele"]) &&
    isset($_POST["rh_exten"]) &&
    isset($_POST["rh_correo"]) &&
    isset($_POST["ti_nombre"]) &&
    isset($_POST["ti_paterno"]) &&
    isset($_POST["ti_materno"]) &&
    isset($_POST["ti_tele"]) &&
    isset($_POST["ti_exten"]) &&
    isset($_POST["ti_correo"]) &&
    isset($_POST["ac_nombre"]) &&
    isset($_POST["ac_paterno"]) &&
    isset($_POST["ac_materno"]) &&
    isset($_POST["ac_tele"]) &&
    isset($_POST["ac_exten"]) &&
    isset($_POST["ac_correo"])
){ 
    /**se inserta la empresa */ 
    $rfc_empresa = $_POST["rfc"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $resultado1 = $objeto->insertar_empresa($rfc_empresa,$_POST["nombre"],$_POST["calle"],
                                $_POST["inicio"],$_POST["fin"],$_POST["razon"],$_POST["correo"],$password);
    
    $resultado2 = $objeto->insertar_dias_laborales($rfc_empresa,$_POST["dias"]);

    //insertamos las areas it,rh y capacitacion
    $resultado3 = $objeto->insertar_areas($_POST["rh_nombre"],$_POST["rh_paterno"],$_POST["rh_materno"],
                            $_POST["rh_tele"],$_POST["rh_exten"],$_POST["rh_correo"],1,$rfc_empresa);

    $resultado4 =$objeto->insertar_areas($_POST["ti_nombre"],$_POST["ti_paterno"],$_POST["ti_materno"],
                            $_POST["ti_tele"],$_POST["ti_exten"],$_POST["ti_correo"],2,$rfc_empresa);

    $resultado5 =$objeto->insertar_areas($_POST["ac_nombre"],$_POST["ac_paterno"],$_POST["ac_materno"],
                            $_POST["ac_tele"],$_POST["ac_exten"],$_POST["ac_correo"],3,$rfc_empresa);

    //establecemos el tipo de usuario que es la empresa
    $resultado6 =$objeto->establecer_tipo_usuario($rfc_empresa,3);
    $resultado7 = $objeto->establecer_colonia_empresa($rfc_empresa,$_POST["colonia"]);
    $resultado8 =$objeto->numero_inteligente($rfc_empresa);

    if ($resultado1 && $resultado2 && $resultado3 && $resultado4 && $resultado5
        && $resultado6 && $resultado7 && $resultado8) {
        $data = ["La empresa se registro con exito"];
    }else{
        $data = ["La empresa no se registro"];
    }

}else if(isset($_POST["codigo_postal"])){


    $data = $objeto->buscar_colonias($_POST["codigo_postal"]);

}

header("Content-Type: application/json");
echo json_encode($data);

?>