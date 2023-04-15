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
                    FROM seguimiento, proyectos, segproyectos
                    WHERE seguimiento.IdSeg = segproyectos.IdSeg and 
                        segproyectos.IdPro = proyectos.IdPro and (seguimiento.IdSeg like :busqueda or proyectos.NomProyecto like :busqueda)";
            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_curso($valor){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCur 
                    FROM seguimiento, cursos, segcursos
                    WHERE seguimiento.IdSeg= segcursos.IdSeg and 
                        segcursos.ClaveCur = cursos.ClaveCur and (seguimiento.IdSeg like :busqueda or NomCur like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_certi($valor){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCertInt 
                    FROM seguimiento, certinterna, segcertint
                    WHERE seguimiento.IdSeg = segcertint.IdSeg and 
                        segcertint.IdCerInt = certinterna.IdCerInt and (seguimiento.IdSeg like :busqueda or NomCertInt like :busqueda)";
            
            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);

            $this->cerrar_conexion();

            return $resultados;
        }

    }

?>