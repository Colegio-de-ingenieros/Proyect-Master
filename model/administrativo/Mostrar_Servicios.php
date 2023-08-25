<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Servicio extends Crud_bd{
        public function buscar_headhunter(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso,usuaperso.ApePPerso,usuaperso.ApeMPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelMPerso, servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter' 
            UNION
            SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaEmp, ('') ,('') ,
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer ,  
            areaempresa.TelFEncArea,servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios,emparea,areaempresa,areaemptipo,areas
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp
            and areaempresa.IdAreaEmp = areaemptipo.IdAreaEmp
            and areaemptipo.IdArea = areas.IdArea
            and areas.IdArea = '1'";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }
        public function buscar_outplacement(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso,usuaperso.ApePPerso,usuaperso.ApeMPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelMPerso, servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            UNION
            SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaEmp, ('') ,('') ,
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer ,  
            areaempresa.TelFEncArea,servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios,emparea,areaempresa,areaemptipo,areas
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp
            and areaempresa.IdAreaEmp = areaemptipo.IdAreaEmp
            and areaemptipo.IdArea = areas.IdArea
            and areas.IdArea = '1'";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }
        function consul_intel_headhunter($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso,usuaperso.ApePPerso,usuaperso.ApeMPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelMPerso, servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and (usuaperso.NomPerso like :busqueda or  usuaperso.CorreoPerso like :busqueda  or  servicios.FechaSer like :busqueda)
            UNION
            SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaEmp, ('') ,('') ,
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer ,  
            areaempresa.TelFEncArea,servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios,emparea,areaempresa,areaemptipo,areas
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp
            and areaempresa.IdAreaEmp = areaemptipo.IdAreaEmp
            and areaemptipo.IdArea = areas.IdArea
            and areas.IdArea = '1'
            and (usuaemp.NomUsuaEmp like :busqueda or  usuaemp.CorreoUsuaEmp like :busqueda or  servicios.FechaSer like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }
        function consul_intel_outplacement($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso,usuaperso.ApePPerso,usuaperso.ApeMPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelMPerso, servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and (usuaperso.NomPerso like :busqueda or  usuaperso.CorreoPerso like :busqueda or  servicios.FechaSer like :busqueda)
            UNION
            SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaEmp, ('') ,('') ,
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer ,  
            areaempresa.TelFEncArea,servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios,emparea,areaempresa,areaemptipo,areas
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp
            and areaempresa.IdAreaEmp = areaemptipo.IdAreaEmp
            and areaemptipo.IdArea = areas.IdArea
            and areas.IdArea = '1'
            and (usuaemp.NomUsuaEmp like :busqueda or  usuaemp.CorreoUsuaEmp like :busqueda or  servicios.FechaSer like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }
        public function buscar_headhunter_individual($id){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso,usuaperso.ApePPerso,usuaperso.ApeMPerso, 
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer , TelMPerso, servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and usuaperso.IdPerso = :id 
            UNION
            SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaEmp, ('') ,('') ,
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer ,  
            areaempresa.TelFEncArea,servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios,emparea,areaempresa,areaemptipo,areas
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp
            and areaempresa.IdAreaEmp = areaemptipo.IdAreaEmp
            and areaemptipo.IdArea = areas.IdArea
            and areas.IdArea = '1'
            and usuaemp.RFCUsuaEmp = :id ";
            $arre = [":id"=> $id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_outplacement_individual($id){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso, usuaperso.CorreoPerso, usuaperso.ApePPerso,usuaperso.ApeMPerso,
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer, TelMPerso, servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaperso.IdPerso = :id 
            UNION
            SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp, usuaemp.CorreoUsuaEmp, ('') ,('') ,
            DATE_FORMAT(FechaSer, '%d/%m/%Y') FechaSer, servicios.EstatusSer ,  
            areaempresa.TelFEncArea,servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios,emparea,areaempresa,areaemptipo,areas
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaemp.RFCUsuaEmp = emparea.RFCUsuaEmp
            and emparea.IdAreaEmp = areaempresa.IdAreaEmp
            and areaempresa.IdAreaEmp = areaemptipo.IdAreaEmp
            and areaemptipo.IdArea = areas.IdArea
            and areas.IdArea = '1'
            and usuaemp.RFCUsuaEmp = :id ";
            $arre = [":id"=> $id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }
    }

?>