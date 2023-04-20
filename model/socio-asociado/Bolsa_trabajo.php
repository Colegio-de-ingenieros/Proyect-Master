<?php
    include('../../config/Crud_bd.php');

    class funciones_bolsa{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function extraer_datos_bolsa(){
            $query = "SELECT bolsaempresa.IdEmpBol, bolsaempresa.VacEmpBol, bolsaempresa.ReqAcaEmpBol, bolsaempresa.ReqTecEmpBol, bolsaempresa.DesEmpBol, bolsaempresa.AñoEmpBol, bolsaempresa.SalBrutoEmpBol, bolsaempresa.SalNetoEmpBol, bolsaempresa.HrIniEmpBol, bolsaempresa.HrFinEmpBol, bolsaempresa.TelEmpBol, bolsaempresa.CalleEmpBol, bolsaempresa.CorreoEmpBol, bolsajornada.IdJor, bolsamodalidades.IdMod, usuaemp.NomUsuaEmp from usuaemp, usuaempbolsa, bolsaempresa, bolsajornada, bolsamodalidades WHERE bolsaempresa.IdEmpBol = usuaempbolsa.IdEmpBol and usuaempbolsa.RFCUsuaEmp = usuaemp.RFCUsuaEmp and bolsajornada.IdEmpBol = bolsaempresa.IdEmpBol and bolsamodalidades.IdEmpBol = bolsaempresa.IdEmpBol";
                        
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