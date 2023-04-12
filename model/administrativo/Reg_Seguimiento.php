<?php
    include('../../config/Crud_bd.php');

    class Seguimiento extends Crud_bd{
        public function buscar_cursos(){
            $this->conexion_bd();
            $sql = "SELECT claveCur, NomCur
                    FROM cursos
                    WHERE EstatusCur !=0";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_proyectos(){
            $this->conexion_bd();
            $sql = "SELECT idPro, NomProyecto
                    FROM proyectos
                    WHERE EstatusPro !=0";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certificaciones(){
            $this->conexion_bd();
            $sql = "SELECT idCerInt, NomCertInt 
                    FROM certinterna
                    WHERE EstatusCertInt !=0";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

    }

?>