<?php
require_once('../../model/administrativo/Modificar_Polizas_Gral.php');
$objeto=new Mostrar_Pol_Gral();

$data =[];

$idPol=$_POST["idOperacion"];

$tipoPol=$_POST["tipo_poliza"];
$concepto=$_POST["concepto_gen"];
$tipoUsua=$_POST["usuario"];
$usuario=$_POST["nombre_us"];
$tipoSer=$_POST["tipo_servicio"];
$servicio=$_POST["nom_servicio"];
$nombreEla=$_POST["nombre"];
$apePEla=$_POST["apellido_pat"];
$apeMEla=$_POST["apellido_mat"];

$result = $objeto->modificar_pol_gral($idPol, $nombreEla, $apePEla, $apeMEla, $concepto);
    if($result == true){
        $result = $objeto->modificar_pol_tipo($idPol, $tipoPol);
        if ($result==true){
            if ($tipoPol<=3){
               $result = $objeto->eliminar_pol_ser_curso_certi($idPol); 
            }
            $result = $objeto->modificar_pol_ser($idPol, $tipoSer, $servicio);
            if ($result==true){
                $result = $objeto->eliminar_pol_usua($idPol);
                $result = $objeto->modificar_pol_usua($idPol, $tipoUsua, $usuario);
                if ($result==true){
                    $data=('Actualización exitosa');
                }
            }else{
                $data=('Ha ocurrido un error al conectar con la base de datos');
            }
        }else{
            $data=('Ha ocurrido un error al conectar con la base de datos');
        }
    }else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }

echo json_encode($data);

?>