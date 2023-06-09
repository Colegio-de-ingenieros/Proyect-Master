<?php
include_once('../../model/administrativo/Mostrar_SocioAsoc_Individual.php');

$objeto=new Mostrar_SocioAsoc();

$data =[];
$idp=$_POST["idP"];

$datos = $objeto->get_datos($idp);
$dire=$objeto->get_direccion($idp);
$grado=$objeto->get_estudios($idp);
$labor=$objeto->get_laborales($idp);


$nom=$datos[0]['NomPerso'];
$ap=$datos[0]['ApePPerso'];
$am=$datos[0]['ApeMPerso'];
$fNac=$datos[0]['FechaNacPerso'];
$telF=$datos[0]['TelFPerso'];
$telM=$datos[0]['TelMPerso'];
$correoP=$datos[0]['CorreoPerso'];
$cedula=$datos[0]['CedulaPerso'];
$calle=$datos[0]['CallePerso'];

if($cedula==null or $cedula=='NULL'){
    $cedula="No registrado";
}

$cp=$dire[0]['codpostal'];
$colonia=$dire[0]['nomcolonia'];
$ciudad=$dire[0]['nommunicipio'];
$estado=$dire[0]['nomestado'];

$estudio=$grado[0]['TipoGrado'];

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
        $empresa,$puesto,$correoL, $telFE,$telExt,$funcion];



echo json_encode($data);

?>