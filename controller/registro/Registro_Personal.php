<?php

require_once('../../model/Reg_personal.php');
$objeto=new Personal();


    $nombre=$_POST["nomPerso"];
    $apeP=$_POST["apePPerso"];
    $apeM=$_POST["apeMPerso"];
    $correo=$_POST["correoPerso"];
    $contra=$_POST["contraPerso"];
    $confiContra=$_POST["confiContraPerso"];
    $ceduPerso=$_POST["opcion5"];
    $telF=$_POST["telFPerso"];
    $telM=$_POST["telMPerso"];
    $fecha=$_POST["fechaNacPerso"];
    $codigoP=$_POST["cpPerso"];
    $calle=$_POST["callePerso"];
    $colonia=$_POST["coloniaPerso"];
    $gradoEst=$_POST["tipoGradoPerso"];
    $pasantia=$_POST["opcion1"];
    $antecedentes=$_POST["opcion2"];
    $veridicas=$_POST["opcion3"];
    $avisos=$_POST["opcion4"];
    $checkboxcertificacion=$_POST["checkboxcertificacionoculto"];
    $checkboxlaboral=$_POST["checkboxlaboraloculto"];


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
    
    if($ceduPerso=='opcion1'){
        $ceduPersona=1;
    }else{
        $ceduPersona=0;
    }

    if(isset($_POST["cedulaPerso"])){
        $cedula=$_POST["cedulaPerso"];
    }else{
        $cedula="NULL";
    }


                
    $password = password_hash($contra, PASSWORD_DEFAULT);

    $idUsua = $objeto->id_usuaperso();
    $idEmpPerso = $objeto->obtener_id_emp_perso();
    $idFuncion = $objeto->obtener_id_empresa_funcion();
    $idCertExt = $objeto->obtener_id_certificacion();
    $result = $objeto->numero_inteligente($idUsua);
    $correoExiste=$objeto->existeCorreo($correo);
    $consecutivo=$result[0]; 
    $numIntel =$result[1];

    //echo $ceduPersona;
    //echo json_encode($checkboxlaboral);

    if($correoExiste){
        echo json_encode('existe');
    }else{

    if ($checkboxcertificacion== 'desactivado' and $checkboxlaboral=='desactivado'){
        $u=$objeto->insertar_normal($idUsua, $nombre, $apeP, $apeM, $fecha, $telF, $telM, $correo, $password, $cedula, $calle, $colonia,
        $gradoEst, $pasan, $antece, $veridi, $aviso, $consecutivo, $numIntel, $ceduPersona);
    }
    else if($checkboxcertificacion == 'activado' and $checkboxlaboral=='desactivado'){  
        $certifi=$_POST["nomCert"];
        $orgCert=$_POST["orgCert"];
        $fechaICert=$_POST["fechaICert"];
        $fechaFCert=$_POST["fechaFCert"];
        $u=$objeto->insertar_conCerti($idUsua, $nombre, $apeP, $apeM, $fecha, $telF, $telM, $correo, $password, $cedula, $calle, $colonia,
        $gradoEst, $pasan,  $idCertExt, $certifi, $orgCert, $fechaICert, $fechaFCert, $antece, $veridi, $aviso, $consecutivo, $numIntel, $ceduPersona);
    }
    else if ($checkboxlaboral=='activado' and $checkboxcertificacion== 'desactivado'){
        $empresaLab=$_POST["nomEmpPerso"];
        $puestoEmp=$_POST["puestoEmpPerso"];
        $correoEmp=$_POST["correoEmpPerso"];
        $extTelFEmp=$_POST["ExtTelFEmp"];
        $telFEmp=$_POST["telFEmpPerso"];
        $funcionEmp=$_POST["funcionEmpPerso"];
        $u=$objeto->insertar_conLaboral($idUsua, $nombre, $apeP, $apeM, $fecha, $telF, $telM, $correo, $password, $cedula, $calle, $colonia,
        $gradoEst, $pasan,  $antece, $veridi, $aviso, $consecutivo, $numIntel, $idEmpPerso, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $idFuncion, $funcionEmp, $ceduPersona);
    }
    else if ($checkboxcertificacion== 'activado' and $checkboxlaboral=='activado'){
        //echo json_encode($colonia);
        $certifi=$_POST["nomCert"];
        $orgCert=$_POST["orgCert"];
        $fechaICert=$_POST["fechaICert"];
        $fechaFCert=$_POST["fechaFCert"];
        $empresaLab=$_POST["nomEmpPerso"];
        $puestoEmp=$_POST["puestoEmpPerso"];
        $correoEmp=$_POST["correoEmpPerso"];
        $extTelFEmp=$_POST["ExtTelFEmp"];
        $telFEmp=$_POST["telFEmpPerso"];
        $funcionEmp=$_POST["funcionEmpPerso"];
        $u=$objeto->insertar_usuaCompleto($idUsua, $nombre, $apeP, $apeM, $fecha, $telF, $telM, $correo, $password, $cedula, $calle, $colonia,
        $gradoEst, $pasan, $antece, $veridi, $aviso, $consecutivo, $numIntel, $idCertExt, $certifi, $orgCert, $fechaICert, $fechaFCert, $idEmpPerso, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $idFuncion, $funcionEmp, $ceduPersona);
    }

    //falta mandar el correo
    $objeto->mandar_correo($correo,$numIntel,$nombre);
    if($u==true){
        echo json_encode('exito');
        
    }else{
        echo json_encode('no exito');
        
    }
}
    
                    

    
    
