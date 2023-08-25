<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Servicios{
        private $bd;

        function BD(){
            $this -> bd = new Crud_bd();
            $this -> bd -> conexion_bd();
        }

        function get_rfc($correo){
            $consulta = "SELECT RFCUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp) =  binary(:user)";
            $parametros = [":user" => $correo];
            $resultados = $this -> bd -> mostrar($consulta,$parametros);
            return $resultados;
        }

        function servicios_solicitados($id){
            $consulta = "SELECT tiposervicios.TipoSer, DATE_FORMAT(servicios.FechaSer,'%d/%m/%Y') AS FechaSer, servicios.EstatusSer, servicios.IdSer 
            FROM empservicios, servicios, sertipo, tiposervicios 
            WHERE empservicios.RFCUsuaEmp = :id 
            AND empservicios.IdSer = servicios.IdSer 
            AND servicios.IdSer = sertipo.IdSer 
            AND sertipo.IdTipoSer = tiposervicios.IdTipoSer";
            $parametros = [":id" => $id];
            $resultados = $this -> bd -> mostrar($consulta,$parametros);
            
            return $resultados;
        }

        function servicios_solicitados_headhunter($id){
            $consulta = "SELECT tiposervicios.TipoSer, DATE_FORMAT(servicios.FechaSer,'%d/%m/%Y') AS FechaSer, servicios.EstatusSer, servicios.IdSer 
            FROM empservicios, servicios, sertipo, tiposervicios 
            WHERE empservicios.RFCUsuaEmp = :id 
            AND empservicios.IdSer = servicios.IdSer 
            AND servicios.IdSer = sertipo.IdSer 
            AND sertipo.IdTipoSer = tiposervicios.IdTipoSer
            AND tiposervicios.IdTipoSer = '1' ";
            $parametros = [":id" => $id];
            $resultados = $this -> bd -> mostrar($consulta,$parametros);
            
            return $resultados;
        }

        function servicios_solicitados_outplacement($id){
            $consulta = "SELECT tiposervicios.TipoSer, DATE_FORMAT(servicios.FechaSer,'%d/%m/%Y') AS FechaSer, servicios.EstatusSer, servicios.IdSer 
            FROM empservicios, servicios, sertipo, tiposervicios 
            WHERE empservicios.RFCUsuaEmp = :id 
            AND empservicios.IdSer = servicios.IdSer 
            AND servicios.IdSer = sertipo.IdSer 
            AND sertipo.IdTipoSer = tiposervicios.IdTipoSer
            AND tiposervicios.IdTipoSer = '2' ";
            $parametros = [":id" => $id];
            $resultados = $this -> bd -> mostrar($consulta,$parametros);
            
            return $resultados;
        }

        function cancelar_servicio($id){
            $consulta = "UPDATE servicios SET EstatusSer = '3' WHERE IdSer = :id";
            $parametros = [":id" => $id];
            $this -> bd -> insertar_eliminar_actualizar($consulta,$parametros);
            
            return "Servicio cancelado";
        }

        function busqueda_inteligente($contenido){
            $query = "SELECT tiposervicios.TipoSer, DATE_FORMAT(servicios.FechaSer,'%d/%m/%Y') AS FechaSer, servicios.EstatusSer, servicios.IdSer 
            FROM empservicios, servicios, sertipo, tiposervicios 
            WHERE empservicios.RFCUsuaEmp = 'P0005' 
            AND empservicios.IdSer = servicios.IdSer 
            AND servicios.IdSer = sertipo.IdSer 
            AND sertipo.IdTipoSer = tiposervicios.IdTipoSer
            AND servicios.FechaSer = :contenido";
            $parametros = [":contenido" => $contenido];
            $resultados = $this -> bd -> mostrar($query,$parametros);

            return $resultados;
        }
    }
?>