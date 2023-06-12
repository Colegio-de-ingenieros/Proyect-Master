<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Servicio extends Crud_bd{
        public function buscar_headhunter(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelMPerso, servicios.IdSer
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
            $sql = "SELECT usuaemp.RFCUsuaEmp, areaempresa.NomEncArea, areaempresa.CorreoEncArea, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelFEncArea, 
            areaempresa.IdAreaEmp, servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios, areaempresa, emparea
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp 
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp ";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        
        function consul_intel_headhunter($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso,usuaperso.NomPerso, usuaperso.TelMPerso, usuaperso.CorreoPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelMPerso, servicios.IdSer
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
            $sql = "SELECT usuaemp.RFCUsuaEmp, areaempresa.NomEncArea, areaempresa.CorreoEncArea, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelFEncArea,
            areaempresa.IdAreaEmp, servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios, areaempresa, emparea
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp 
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp 
            and (areaempresa.NomEncArea like :busqueda or areaempresa.CorreoEncArea like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        public function buscar_headhunter_individual($id){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer, TelMPerso, servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and usuaperso.IdPerso = :id ";
            $arre = [":id"=> $id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_outplacement_individual($id){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, areaempresa.NomEncArea, areaempresa.CorreoEncArea, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelFEncArea, servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios, areaempresa, emparea
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp 
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp 
            and areaempresa.IdAreaEmp = :id ";
            $arre = [":id"=> $id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

    }

?>