<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Servicio extends Crud_bd{
        public function buscar_headhunter(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.NomPerso, usuaperso.CorreoPerso, 
            servicios.FechaSer, servicios.EstatusSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter' ";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_outplacement(){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaemp, 
            servicios.FechaSer, servicios.EstatusSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement' ";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        
        function consul_intel_headhunter($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.NomPerso, usuaperso.TelMPerso, usuaperso.CorreoPerso, 
            servicios.FechaSer, servicios.EstatusSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and (usuaperso.NomPerso like :busqueda or  usuaperso.CorreoPerso like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_outplacement($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaemp, 
            servicios.FechaSer, servicios.EstatusSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement' 
            and (usuaemp.NomUsuaEmp like :busqueda or usuaemp.CorreoUsuaemp like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

    }

?>