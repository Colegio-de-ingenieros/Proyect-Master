<?php

require_once('../../model/administrativo/Reg_General_Polizas.php');
$obj=new NuevaPoliza();
$obj->conexion();
$data =[];

$tipo_pol = $_POST["tipo_poliza"];
$concepto_gral= $_POST["concepto_gen"];
$usuario = $_POST["usuario"];
$nom_usuario = $_POST["nombre_us"];
$servicio = $_POST["tipo_servicio"];
$nom_servicio = $_POST["nom_servicio"];
$nombre = $_POST["nombre"];
$ape_pat= $_POST["apellido_pat"];
$ape_mat = $_POST["apellido_mat"];

if($nom_usuario!='' && $nom_servicio!=''){
    

    //obtiene fecha del sistema
    date_default_timezone_set('America/Mexico_City');

    $fecha_actual = getdate();
    $fecha= $fecha_actual['year'] . "-" . $fecha_actual['mon'] . "-" . $fecha_actual['mday'] ;

    $idPol =$obj->buscarUltimoIdPol();

    $obj->insertar($idPol, $nombre, $ape_pat, $ape_mat, $concepto_gral, $fecha,$tipo_pol,$servicio);

    if ($servicio==4){
        $obj->insertaCurso($idPol, $nom_servicio);
    }
    if ($servicio==5){
        $obj->insertaCertificacion($idPol, $nom_servicio);
    }
    if ($usuario==1 or $usuario==2){
        $obj->insertaUsuaPerso($idPol, $nom_usuario);
    }
    if ($usuario==3){
        $obj->insertaUsuaEmp($idPol, $nom_usuario);
    }

    $resultados = $obj->buscarPorId($idPol);

    if($resultados == true){
        $data=['Correcto',$idPol];
    }

    else{
        $data='Ha ocurrido un error al conectar con la base de datos';
    }
}

echo json_encode($data)

?>