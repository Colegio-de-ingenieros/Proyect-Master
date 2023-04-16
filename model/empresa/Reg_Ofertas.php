<?php
    include('../../config/Crud_bd.php');

    class NuevaOferta{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }
        function obtenerId(){
            $querry = "SELECT IdEmpBol FROM bolsaempresa ORDER BY IdEmpBol DESC LIMIT 1";
            $resultados = $this->base->mostrar($querry);
            if ($resultados == null) {
                return 0;
            }
        else{
                return $resultados[0]['IdEmpBol'];
            }
        }

        //manda las consultas para insertar en las tablas de certificaciones internas e historicos
        function insertar($id, $nom, $aca, $tec, $descr, $exp, $bruto, $mensual, $ini, $fin, $tel, $calle, $correo, $jornada){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO bolsaempresa (IdEmpBol,VacEmpBol,ReqAcaEmpBol,ReqTecEmpBol,DesEmpBol,
            AñoEmpBol,SalBrutoEmpBol,SalNetoEmpBol,	HrIniEmpBol,HrFinEmpBol,TelEmpBol,CalleEmpBol,CorreoEmpBol)
            VALUES(:idemp, :nom, :aca, :tec, :descr, :exp, :bruto, :mensual, :ini, :fin, :tel, :calle, :correo)";
            $a1= ["idemp"=>$id, ":nom"=>$nom, ":aca"=>$aca, ":tec"=>$tec, ":descr"=>$descr, ":exp"=>$exp, ":bruto"=>$bruto, ":mensual"=>$mensual, ":ini"=>$ini,
             ":fin"=>$fin, ":tel"=>$tel, ":calle"=>$calle, ":correo"=>$correo];
            //acomoda todo en arreglos para mandarlos al CRUD
            $q2="INSERT INTO bolsajornada (IdEmpBol,IdJor)
            VALUES (:id, :jornada)";
            $a2= [":id"=>$id,":jornada"=>$jornada];

            $querry = [$q1];
            $parametros = [$a1];           ;
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
            
        }
        
    }

?>