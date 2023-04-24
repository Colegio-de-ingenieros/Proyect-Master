<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Seguimiento extends Crud_bd{
        public function buscar_cursos(){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCur 
                    FROM seguimiento, cursos, segcursos
                    WHERE seguimiento.IdSeg= segcursos.IdSeg and 
                        segcursos.ClaveCur = cursos.ClaveCur";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_proyectos(){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomProyecto
                    FROM seguimiento, proyectos, segproyectos
                    WHERE seguimiento.IdSeg= segproyectos.IdSeg and 
                        segproyectos.IdPro = proyectos.IdPro";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certificaciones(){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCertInt 
                    FROM seguimiento, certinterna, segcertint
                    WHERE seguimiento.IdSeg= segcertint.IdSeg and 
                        segcertint.IdCerInt = certinterna.IdCerInt";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        
        function consul_intel_proyecto($valor){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomProyecto
                    FROM seguimiento, proyectos, segproyectos, persoparticipa, usuaperso, empparticipa, usuaemp, insparticipa, instructor
                    WHERE seguimiento.IdSeg = segproyectos.IdSeg and segproyectos.IdPro = proyectos.IdPro 
                    and persoparticipa.IdSeg=seguimiento.IdSeg and persoparticipa.IdPerso=usuaperso.IdPerso 
                    and empparticipa.IdSeg=seguimiento.IdSeg and empparticipa.RFCUsuaEmp=usuaemp.RFCUsuaEmp 
                    and insparticipa.IdSeg=seguimiento.IdSeg and insparticipa.ClaveIns=instructor.ClaveIns and 
                    (seguimiento.IdSeg like :busqueda or proyectos.NomProyecto like :busqueda or usuaperso.NomPerso like :busqueda or
                    usuaemp.NomUsuaEmp like :busqueda or instructor.NomIns like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_curso($valor){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCur 
                    FROM seguimiento, cursos, segcursos,persoparticipa, usuaperso, empparticipa, usuaemp, insparticipa, instructor
                    WHERE seguimiento.IdSeg= segcursos.IdSeg and segcursos.ClaveCur = cursos.ClaveCur 
                    and persoparticipa.IdSeg=seguimiento.IdSeg and persoparticipa.IdPerso=usuaperso.IdPerso 
                    and empparticipa.IdSeg=seguimiento.IdSeg and empparticipa.RFCUsuaEmp=usuaemp.RFCUsuaEmp 
                    and insparticipa.IdSeg=seguimiento.IdSeg and insparticipa.ClaveIns=instructor.ClaveIns and 
                    (seguimiento.IdSeg like :busqueda or NomCur like :busqueda  or usuaperso.NomPerso like :busqueda or
                    usuaemp.NomUsuaEmp like :busqueda or instructor.NomIns like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_certi($valor){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCertInt 
                    FROM seguimiento, certinterna, segcertint,persoparticipa, usuaperso, empparticipa, usuaemp, insparticipa, instructor
                    WHERE seguimiento.IdSeg = segcertint.IdSeg and segcertint.IdCerInt = certinterna.IdCerInt 
                    and persoparticipa.IdSeg=seguimiento.IdSeg and persoparticipa.IdPerso=usuaperso.IdPerso 
                    and empparticipa.IdSeg=seguimiento.IdSeg and empparticipa.RFCUsuaEmp=usuaemp.RFCUsuaEmp 
                    and insparticipa.IdSeg=seguimiento.IdSeg and insparticipa.ClaveIns=instructor.ClaveIns and
                    (seguimiento.IdSeg like :busqueda or NomCertInt like :busqueda or usuaperso.NomPerso like :busqueda or
                    usuaemp.NomUsuaEmp like :busqueda or instructor.NomIns like :busqueda)";
            
            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);

            $this->cerrar_conexion();

            return $resultados;
        }

    }

?>