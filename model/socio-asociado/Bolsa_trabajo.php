<?php
    include('../../config/Crud_bd.php');

    class funciones_bolsa{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function extraer_datos_bolsa(){
            $query = "SELECT bolsaempresa.IdEmpBol, bolsaempresa.VacEmpBol, bolsaempresa.ReqAcaEmpBol, bolsaempresa.ReqTecEmpBol, bolsaempresa.DesEmpBol, bolsaempresa.AñoEmpBol, bolsaempresa.SalBrutoEmpBol, bolsaempresa.SalNetoEmpBol, bolsaempresa.HrIniEmpBol, bolsaempresa.HrFinEmpBol, bolsaempresa.TelEmpBol, bolsaempresa.CalleEmpBol, bolsaempresa.CorreoEmpBol, bolsajornada.IdJor, bolsamodalidades.IdMod, usuaemp.NomUsuaEmp, colonias.nomcolonia, municipios.nommunicipio, estados.nomestado 
            from usuaemp, usuaempbolsa, bolsaempresa, bolsajornada, bolsamodalidades, usuaemplugares, colonias, municipios, estados 
            WHERE bolsaempresa.IdEmpBol = usuaempbolsa.IdEmpBol 
            and usuaempbolsa.RFCUsuaEmp = usuaemp.RFCUsuaEmp 
            and bolsajornada.IdEmpBol = bolsaempresa.IdEmpBol 
            and bolsamodalidades.IdEmpBol = bolsaempresa.IdEmpBol 
            and usuaemp.RFCUsuaEmp = usuaemplugares.RFCUsuaEmp 
            and usuaemplugares.IdColonia = colonias.IdColonia 
            and municipios.idmunicipio = colonias.idmunicipio 
            and estados.idestado = municipios.idestado
            and bolsaempresa.EstatusEmpBol = 1";
            $resultados = $this->base->mostrar($query);

            if ($resultados != null){
                return $resultados;
            }
            else{
                return "No se encontraron resultados";
            }
        }

        function extraer_dias_laborales($id){
            $consulta = "SELECT IdLab
            FROM `empboldias` 
            WHERE IdEmpBol = :id ";
            $parametros = ['id' => $id];
            $resultados = $this->base->mostrar($consulta, $parametros);
            
            if ($resultados != null){
                return $resultados;
            }
            else{
                return "No se encontraron días laborales";
            }
        }
    }

    $obj = new funciones_bolsa();
    $obj -> conexion();
    $obj -> extraer_datos_bolsa();
?>