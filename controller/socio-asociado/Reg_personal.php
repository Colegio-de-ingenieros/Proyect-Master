<?php
    include('../../config/Crud_bd.php')

    class Personal{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }
        

        function registrar(){
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

            echo $nombre;
            echo $apeP;
            echo $apeM;
            echo $correo;
            echo $contra;
            echo $confiContra;
            echo $cedula;
            echo $telF;
            echo $telM;
            echo $fecha;
            echo $codigoP;
            echo $calle;
            echo $colonia;
            echo $ciudad;
            echo $estado;
            echo $certifi;
            echo $gradoEst;
            echo $pasan;
            echo $EmpresaLab;
            echo $puestoEmp;
            echo $correoEmp;
            echo $telFEmp;
            echo $funcionEmp;
            echo $antece;
            echo $veridi;
            echo $aviso;
        }

    }







$obj = new Personal;
$obj -> registrar();
?>