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
        function insertar($id, $nom, $aca, $tec, $descr, $exp, $bruto, $mensual, $ini, $fin, $tel, $calle, $correo, $jornada, $colonia, $modalidad, $c1, $c2, $c3, $c4, $c5, $c6, $c7){
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
            $q3="INSERT INTO bolsacvlugares (IdEmpBol,IdColonia) 
            VALUES (:id, :colonia)";
            $a3= [":id"=>$id,":colonia"=>$colonia];
            $q4= "INSERT INTO bolsamodalidades (IdEmpBol,IdMod)
            Values (:id, :modalidad)";
            $a4= [":id"=>$id,":modalidad"=>$modalidad];
            $querry = [$q1,$q2,$q3,$q4];
            $parametros = [$a1,$a2,$a3,$a4];
            $this->base->insertar_eliminar_actualizar($querry, $parametros);

            //Para insertar los dias
            if ($c1==1){
                $qd1= "INSERT INTO empboldias (IdEmpBol,IdLab)
            Values (:id, :c1)";
            $da1= [":id"=>$id,":c1"=>$c1];
            $this->base->insertar_eliminar_actualizar($qd1, $da1);
            }
            if ($c2==2){
                $qd2= "INSERT INTO empboldias (IdEmpBol,IdLab)
            Values (:id, :c2)";
            $da2= [":id"=>$id,":c2"=>$c2];
            $this->base->insertar_eliminar_actualizar($qd2, $da2);
            }
            if ($c3==3){
                $qd3= "INSERT INTO empboldias (IdEmpBol,IdLab)
            Values (:id, :c3)";
            $da3= [":id"=>$id,":c3"=>$c3];
            $this->base->insertar_eliminar_actualizar($qd3, $da3);
            }
            if ($c4==4){
                $qd4= "INSERT INTO empboldias (IdEmpBol,IdLab)
            Values (:id, :c4)";
            $da4= [":id"=>$id,":c4"=>$c4];
            $this->base->insertar_eliminar_actualizar($qd4, $da4);
            }
            if ($c5==5){
                $qd5= "INSERT INTO empboldias (IdEmpBol,IdLab)
            Values (:id, :c5)";
            $da5= [":id"=>$id,":c5"=>$c5];
            $this->base->insertar_eliminar_actualizar($qd5, $da5);
            }
            if ($c6==6){
                $qd6= "INSERT INTO empboldias (IdEmpBol,IdLab)
            Values (:id, :c6)";
            $da6= [":id"=>$id,":c6"=>$c6];
            $this->base->insertar_eliminar_actualizar($qd6, $da6);
            }
            if ($c7==7){
                $qd7= "INSERT INTO empboldias (IdEmpBol,IdLab)
            Values (:id, :c7)";
            $da7= [":id"=>$id,":c7"=>$c7];
            $this->base->insertar_eliminar_actualizar($qd7, $da7);
            }
            
            
        }
        
    }

?>