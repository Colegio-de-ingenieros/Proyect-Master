<?php
    include('../../config/Crud_bd.php');

    class funciones_bolsa{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function extraer_datos_bolsa(){
            $query = "SELECT bolsaempresa.IdEmpBol, VacEmpBol, ReqAcaEmpBol, ReqTecEmpBol, DesEmpBol, AñoEmpBol,SalBrutoEmpBol,SalNetoEmpBol,HrIniEmpBol,HrFinEmpBol,TelEmpBol,CorreoEmpBol, idJor, IdMod FROM `bolsaempresa`, `bolsajornada`, `bolsamodalidades`";
            $resultados = $this->base->mostrar($query);

            if ($resultados != null){
                return $resultados;
            }
            else{
                return "No se encontraron resultados";
            }
        }
    }

    $obj = new funciones_bolsa();
    $obj -> conexion();
    $obj -> extraer_datos_bolsa();
?>