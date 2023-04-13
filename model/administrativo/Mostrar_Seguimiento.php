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
            $sql = "SELECT seguimiento.IdSeg, NomCertInt 
                    FROM seguimiento, certinterna, segcertint
                    WHERE seguimiento.IdSeg= segcertint.IdSeg and 
                        segcertint.IdCerInt = certinterna.IdCerInt";
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

    }

?>