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
            FROM bolsaempresa, bolsajornada, bolsamodalidades, usuaemp, usuaempbolsa, colonias, municipios, estados, bolsacvlugares
            WHERE bolsaempresa.IdEmpBol = usuaempbolsa.IdEmpBol 
            AND usuaempbolsa.RFCUsuaEmp = usuaemp.RFCUsuaEmp 
            AND bolsajornada.IdEmpBol = bolsaempresa.IdEmpBol 
            AND bolsamodalidades.IdEmpBol = bolsaempresa.IdEmpBol 
            AND bolsacvlugares.IdEmpBol = bolsaempresa.IdEmpBol
            AND bolsacvlugares.IdColonia = colonias.IdColonia
            AND municipios.idmunicipio = colonias.idmunicipio 
            AND estados.idestado = municipios.idestado
            AND bolsaempresa.EstatusEmpBol = 1";
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