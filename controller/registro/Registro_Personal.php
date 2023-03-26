<?php
require_once('../../model/Reg_personal.php');
$objeto=new Personal();


if(
    isset ($_POST["nomPerso"]) &&
    isset ($_POST["apePPerso"]) &&
    isset ($_POST["apeMPerso"]) &&
    isset ($_POST["correoPerso"]) &&
    isset ($_POST["contraPerso"]) &&
    isset ($_POST["confiContraPerso"]) &&
    isset ($_POST["cedulaPerso"]) &&
    isset ($_POST["telFPerso"]) &&
    isset ($_POST["telMPerso"]) &&
    isset ($_POST["fechaNacPerso"]) &&
    isset ($_POST["cpPerso"]) &&
    isset ($_POST["callePerso"]) &&
    isset ($_POST["coloniaPerso"]) &&
    isset ($_POST["ciudadPerso"]) &&
    isset ($_POST["estadoPerso"]) &&
    isset ($_POST["nomCert"]) &&
    isset ($_POST["orgCert"]) &&
    isset ($_POST["fechaICert"]) &&
    isset ($_POST["fechaFCert"]) &&
    isset ($_POST["tipoGradoPerso"]) &&
    isset ($_POST["opcion1"]) &&
    isset ($_POST["nomEmpPerso"]) &&
    isset ($_POST["puestoEmpPerso"]) &&
    isset ($_POST["correoEmpPerso"]) &&
    isset ($_POST["telFEmpPerso"]) &&
    isset ($_POST["ExtTelFEmp"]) &&
    isset ($_POST["funcionEmpPerso"]) &&
    isset ($_POST["opcion2"]) &&
    isset ($_POST["opcion3"]) &&
    isset ($_POST["opcion4"]) &&
    isset ($_POST["checkboxcertificacionoculto"]) &&
    isset ($_POST["checkboxlaboraloculto"])
){
    $nombre=$_POST["nomPerso"];
    $apeP=$_POST["apePPerso"];
    $apeM=$_POST["apeMPerso"];
    $correo=$_POST["correoPerso"];
    $contra=$_POST["contraPerso"];
    $confiContra=$_POST["confiContraPerso"];
    $cedula=$_POST["cedulaPerso"];
    $telF=$_POST["telFPerso"];
    $telM=$_POST["telMPerso"];
    $fecha=$_POST["fechaNacPerso"];
    $codigoP=$_POST["cpPerso"];
    $calle=$_POST["callePerso"];
    $colonia=$_POST["coloniaPerso"];
    $ciudad=$_POST["ciudadPerso"];
    $estado=$_POST["estadoPerso"];
    $certifi=$_POST["nomCert"];
    $orgCert=$_POST["orgCert"];
    $fechaICert=$_POST["fechaICert"];
    $fechaFCert=$_POST["fechaFCert"];
    $gradoEst=$_POST["tipoGradoPerso"];
    $pasantia=$_POST["opcion1"];
    $empresaLab=$_POST["nomEmpPerso"];
    $puestoEmp=$_POST["puestoEmpPerso"];
    $correoEmp=$_POST["correoEmpPerso"];
    $extTelFEmp=$_POST["ExtTelFEmp"];
    $telFEmp=$_POST["telFEmpPerso"];
    $funcionEmp=$_POST["funcionEmpPerso"];
    $antecedentes=$_POST["opcion2"];
    $veridicas=$_POST["opcion3"];
    $avisos=$_POST["opcion4"];
    $checkboxcertificacion=$_POST["checkboxcertificacionoculto"];
    $checkboxlaboral=$_POST["checkboxlaboraloculto"];

    echo $checkboxcertificacion;
    echo $checkboxlaboral;


    if($pasantia=='opcion1'){
        $pasan=1;
    }else{
        $pasan=0;
    }
                    
    if($antecedentes=='opcion1'){
        $antece=1;
    }else{
        $antece=0;
    }
                    
    if($veridicas=='opcion1'){
        $veridi=1;
    }else{
        $veridi=0;
    }
    
    if($avisos=='opcion1'){
        $aviso=1;
    }else{
        $aviso=0;
    }


                
    $password = password_hash($contra, PASSWORD_DEFAULT);

    $idUsua = $objeto->id_usuaperso();
    $idEmpPerso = $objeto->obtener_id_emp_perso();
    $idFuncion = $objeto->obtener_id_empresa_funcion();
    $idCertExt = $objeto->obtener_id_certificacion();
    $result = $objeto->numero_inteligente($idUsua);
    $consecutivo=$result[0]; 
    $numIntel =$result[1];

    //echo json_encode($checkboxlaboral);

    $u=$objeto->insertar_usuaperso($idUsua, $nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $password, $idEmpPerso, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $idFuncion, $funcionEmp, $idCertExt, $certifi, $orgCert, $fechaICert, $fechaFCert, $gradoEst, $colonia, $consecutivo, $numIntel, $checkboxcertificacion, $checkboxlaboral);

    //echo json_encode($u);

    //falta mandar el correo

    if($u==true){
        echo json_encode('exito');
        
    }else{
        echo json_encode('no exito');
        
    }
    
                    

    
    
}