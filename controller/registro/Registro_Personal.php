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

    $bandn = 0;
    $bandc = 0;
    $bandM = 0;
    $bandm = 0;
    $confi = False;
    if($contra == $confiContra){
        if(strlen($contra) >= 8){
            for($i=0;$i<strlen($contra);$i++){
                //verificar que tenga numeros
                if(ord($contra[$i])>=48 and ord($contra[$i])<=57){
                    $bandn ++;
                }
                //verificar que tenga caracteres especiales
                if((ord($contra[$i]) <=47 or ord($contra[$i])>=58) and (ord($contra[$i])<=64 or ord($contra[$i])>=91) and (ord($contra[$i])<=96 or ord($contra[$i])>=123)){
                    $bandc ++;
                }

                //verificar que tenga mayusculas
                if(ord($contra[$i])>=65 and ord($contra[$i])<=90){
                    $bandM ++;
                }

                //verificar que tenga minusculas
                if(ord($contra[$i])>=97 and ord($contra[$i])<=122){
                    $bandm ++;
                }
            }

            if($bandn == 0){
                echo json_encode("numeros");
                //$in->alertas("validacion", 'Datos inválidos', 'La contraseña debe contener números');
            }

            else if($bandM == 0 or $bandm == 0){
                echo json_encode("mayusculas");
                //$in->alertas("validacion", 'Datos inválidos', 'La contraseña debe contener mayúsculas y minúsculas');
            }

            else if($bandc == 0){
                echo json_encode("caracteres");
                //$in->alertas("validacion", 'Datos inválidos', 'La contraseña debe tener al menos un carácter especial');
            }

            else{
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
                
                    
                    //$objeto->numero_inteligente($correo);
                    //$resultado = $objeto->inserciones();
                    $resultado1=$objeto->insertar_usuaperso($nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $password, $codigoP, $gradoEst, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $certifi, $orgCert, $fechaICert, $fechaFCert, $funcionEmp);
                    
                
                    if($resultado1==False){
                        echo json_encode('exito');
                        
                    }else{
                        echo json_encode('no exito');
                        
                    }
            }
        }

        else{
            echo json_encode("longitud");
            //$in->alertas("validacion", 'Datos inválidos', 'La contraseña debe tener un mínimo de 8 caracteres');
        }
    }

    else {
        echo json_encode("coincidencia");
        //$in->alertas("validacion", 'Datos inválidos', 'La contraseña y la confirmación no coinciden');
    }

    
    
}