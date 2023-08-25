<?php
include_once('../../model/administrativo/Mostrar_SocioAsoc_Individual.php');

$objeto=new Mostrar_SocioAsoc();

$data =[];
$idp=$_POST["idP"];


$tipo_usua = $objeto->get_tipo_usuario($idp);
$datos = $objeto->get_datos($idp);
$dire=$objeto->get_direccion($idp);
$grado=$objeto->get_estudios($idp);
$labor=$objeto->get_laborales($idp);


$valor_usua=$tipo_usua[0]['IdUsua'];

if($valor_usua==1){
    $valor_usua="Datos del asociado";
}else{
    $valor_usua="Datos del socio";
}


$nom=$datos[0]['NomPerso'];
$ap=$datos[0]['ApePPerso'];
$am=$datos[0]['ApeMPerso'];
$fNac=$datos[0]['FechaNacPerso'];
$telF=$datos[0]['TelFPerso'];
$telM=$datos[0]['TelMPerso'];
$correoP=$datos[0]['CorreoPerso'];
$cedula=$datos[0]['CedulaPerso'];
$calle=$datos[0]['CallePerso'];
$cedulaSiNo=$datos[0]['ceduPerso'];


if($am==null or $am=='NULL'){
    $am="No registrado";
}

if($telF==null or $telF=='NULL'){
    $telF="No registrado";
}

if($cedulaSiNo==1){
    $cedulaSiNo="Si";
}else{
    $cedulaSiNo="No";
}

if($cedula==null or $cedula=='NULL'){
    $cedula="No registrado";
}


$cp=$dire[0]['codpostal'];
$colonia=$dire[0]['nomcolonia'];
$ciudad=$dire[0]['nommunicipio'];
$estado=$dire[0]['nomestado'];

$estudio=$grado[0]['TipoGrado'];
$pasantia=$datos[0]['PasantiaPerso'];

if($pasantia==1){
    $pasantia="Si";
}else{
    $pasantia="No";
}

if($labor!=null){
    $empresa=$labor[0]['NomEmpPerso'];
    $puesto=$labor[0]['PuestoEmpPerso'];
    $correoL=$labor[0]['CorreoEmpPerso'];
    $telFE=$labor[0]['TelFEmpPerso'];
    $telExt=$labor[0]['ExtenTelFEmpPerso'];
    $idEmp=$labor[0]['IdEmpPerso'];
    $resulta=$objeto->get_funciones($idEmp);
    
    $funcion='';
    for ($i=0; $i < count($resulta); $i++){
        $fun = $resulta[$i]["NomFuncion"];
        $funcion=$funcion .$fun. "<br>";
    }
}
else{
    $empresa="No registrado";
    $puesto="No registrado";
    $correoL="No registrado";
    $telFE="No registrado";
    $telExt="No registrado";
    $funcion="No registrado";
}

$data=[$nom, $ap,$am,$fNac,$telF,$telM,$correoP,$cedula,$cp,$calle,$colonia,$ciudad,$estado,$estudio, 
        $empresa,$puesto,$correoL, $telFE,$telExt,$funcion, $cedulaSiNo, $pasantia, $valor_usua];



echo json_encode($data);

?>