<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Polizas extends Crud_bd{
        public function mostrar_Egresos(){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, CoceptoGral, FechaPolGral 
            FROM polgeneral,tipogralpol
            WHERE polgeneral.IdPolGral=tipogralpol.IdPolGral AND IdTipoPol=1";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }
        public function mostrar_Ingresos(){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, CoceptoGral, FechaPolGral
            FROM polgeneral,tipogralpol
            WHERE polgeneral.IdPolGral=tipogralpol.IdPolGral AND IdTipoPol=2";
             $resultado = $this->mostrar($sql);
             $this->cerrar_conexion();
             return $resultado;
        }
        public function buscar_Ingresos($busqueda){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, CoceptoGral, FechaPolGral
            FROM polgeneral,tipogralpol
            WHERE polgeneral.IdPolGral=tipogralpol.IdPolGral AND IdTipoPol=2 
            AND (polgeneral.IdPolGral LIKE :busqueda OR NomElaPol LIKE :busqueda OR ApePElaPol LIKE :busqueda 
            OR ApeMElaPol LIKE :busqueda OR FechaPolGral LIKE :busqueda)";
            $arre = [":busqueda"=>'%'.$busqueda.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultados;
        }
        public function buscar_Egresos($busqueda){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, CoceptoGral, FechaPolGral 
            FROM polgeneral,tipogralpol
            WHERE polgeneral.IdPolGral=tipogralpol.IdPolGral AND IdTipoPol=1
            AND (polgeneral.IdPolGral LIKE :busqueda OR NomElaPol LIKE :busqueda OR ApePElaPol LIKE :busqueda 
            OR ApeMElaPol LIKE :busqueda OR FechaPolGral LIKE :busqueda)";
            $arre = [":busqueda"=>'%'.$busqueda.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultados;
        }
    }
?>