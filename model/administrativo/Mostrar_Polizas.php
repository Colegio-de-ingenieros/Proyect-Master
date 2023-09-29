<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Polizas extends Crud_bd{
        public function Mostrar_Egresos(){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, CoceptoGral, FechaPolGral 
            FROM polgeneral,tipogralpol
            WHERE polgeneral.IdPolGral=tipogralpol.IdPolGral AND IdTipoPol=1";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }
        public function Mostrar_Ingresos(){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, CoceptoGral, FechaPolGral
            FROM polgeneral,tipogralpol
            WHERE polgeneral.IdPolGral=tipogralpol.IdPolGral AND IdTipoPol=2";
             $resultado = $this->mostrar($sql);
             $this->cerrar_conexion();
             return $resultado;
        }
    }
?>