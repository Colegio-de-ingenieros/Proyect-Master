<?php
require_once('../../model/Reg_personal.php');
$objeto=new Personal();
$data=[];

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
    isset ($_POST["noCert"]) &&
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
    isset ($_POST["opcion4"]) 
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
    $noCert=$_POST["noCert"];
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
    $password = password_hash($contra, PASSWORD_DEFAULT);

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

    
    
    $resultado1=$objeto->insertar_usuaperso($nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $password, $codigoP, $gradoEst, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $noCert, $certifi, $orgCert, $fechaICert, $fechaFCert, $funcionEmp);
    


    if($resultado1==False){
        $objeto->numero_inteligente($correo);
        $data=["Se te envio un correo"];
        
    }else{
        $data=["Hubo un error"];
        
    }
    
}else if(isset($_POST["cpPerso"])){


    $data = $objeto->buscar_colonias($_POST["cpPerso"]);

}

echo json_encode($data);

?>