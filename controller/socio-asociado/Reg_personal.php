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
    isset ($_POST["nomCerPerso"]) &&
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
    $certifi=$_POST["nomCerPerso"];
    $gradoEst=$_POST["tipoGradoPerso"];
    $pasantia=$_POST["opcion1"];
    $empresaLab=$_POST["nomEmpPerso"];
    $puestoEmp=$_POST["puestoEmpPerso"];
    $correoEmp=$_POST["correoEmpPerso"];
    $telFEmp=$_POST["telFEmpPerso"];
    $extTelFEmp=$_POST["ExtTelFEmp"];
    $funcionEmp=$_POST["funcionEmpPerso"];
    $antecedentes=$_POST["opcion2"];
    $veridicas=$_POST["opcion3"];
    $avisos=$_POST["opcion4"];
    $password = password_hash($contra, PASSWORD_DEFAULT);

    if($pasantia=='opcion1'){
        $pasan='True';
    }else{
        $pasan='False';
    }

    if($antecedentes=='opcion1'){
        $antece='True';
    }else{
        $antece='False';
    }

    if($veridicas=='opcion1'){
        $veridi='True';
    }else{
        $veridi='False';
    }

    if($avisos=='opcion1'){
        $aviso='True';
    }else{
        $aviso='False';
    }

    $resultado1=$objeto->insertar_usuaperso($nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $password, $codigoP, $gradoEst, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp);
    $resultado2=$objeto->buscar_colonias($codigoP);

    if($resultado1 && $resultado2==True){
        echo "Todo chido";
    }else{
        echo "No todo chido";
    }

}

class Registro{

    function instancias(){
        $this->idP = $this->generarID();
        $this->idEmp = $this->generarID1();
        $this->idF = $this->generarID2();
        $this->idG = $this->generarID3();
        $objeto=new Personal();
        $this->obj->conexion();
    }

    function generarID(){
        $idP=$this->obj->buscarUltimoID();
        $id = floatval($idP) +1; 

        $idP = strval($id);


        for($i=strlen($idP); $i<6; $i++){
            $idP = '0'.$idP;
        }

        return $idP;
    }

    function generarID1(){
        $idEmp=$this->obj->buscarUltimoID1();
        $id = floatval($idEmp) +1; 

        $idEmp = strval($id);


        for($i=strlen($idEmp); $i<6; $i++){
            $idEmp = '0'.$idEmp;
        }

        return $idEmp;
    }

    function generarID2(){
        $idFun=$this->obj->buscarUltimoID2();
        $id = floatval($idFun) +1; 

        $idFun = strval($id);


        for($i=strlen($idFun); $i<6; $i++){
            $idFun = '0'.$idFun;
        }

        return $idFun;
    }

    function generarID3(){
        $idG=$this->obj->buscarUltimoID3();
        $id = floatval($idG) +1; 

        $idG = strval($id);


        for($i=strlen($idG); $i<6; $i++){
            $idG = '0'.$idG;
        }

        return $idG;
    }

    function insertar(){

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
            isset ($_POST["nomCerPerso"]) &&
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
                $certifi=$_POST["nomCerPerso"];
                $gradoEst=$_POST["tipoGradoPerso"];
                $pasantia=$_POST["opcion1"];
                $empresaLab=$_POST["nomEmpPerso"];
                $puestoEmp=$_POST["puestoEmpPerso"];
                $correoEmp=$_POST["correoEmpPerso"];
                $telFEmp=$_POST["telFEmpPerso"];
                $extTelFEmp=$_POST["ExtTelFEmp"];
                $funcionEmp=$_POST["funcionEmpPerso"];
                $antecedentes=$_POST["opcion2"];
                $veridicas=$_POST["opcion3"];
                $avisos=$_POST["opcion4"];

                if($pasantia=='opcion1'){
                    $pasan='True';
                }else{
                    $pasan='False';
                }

                if($antecedentes=='opcion1'){
                    $antece='True';
                }else{
                    $antece='False';
                }

                if($veridicas=='opcion1'){
                    $veridi='True';
                }else{
                    $veridi='False';
                }

                if($avisos=='opcion1'){
                    $aviso='True';
                }else{
                    $aviso='False';
                }

                $password=password_hash($contra, PASSWORD_DEFAULT);

                $resultado1=$objeto->insertar_usuaperso($this->idP, $nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $password);
                $resultado2=$objeto->inserta_usuapersoemp($this->idP, $this->idEmp);
                $resultado3=$objeto->inserta_empresaperso($this->idEmp, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp);
                $resultado4=$objeto->inserta_persoempfun($this->idEmp, $this->idF);
                $resultado5=$objeto->inserta_funciones($this->idF, $funcionEmp);
                $resultado6=$objeto->inserta_persoestudios($this->idP, $this->idG);

                if($resultado1 && $resultado2 && $resultado3 &&
                $resultado4 && $resultado5 && $resultado6){
                    echo "Todo chingon";
                }else{
                    echo "Salio un error";
                }
            }
        }
    }







$obj = new Registro();
$obj -> insertar();
?>