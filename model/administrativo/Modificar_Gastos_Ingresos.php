<?php
    include('../../config/Crud_bd.php');

    class Gastos_Ingresos extends Crud_bd{
        public function modificar_gasto($idGas, $monto, $fecha){
            $this->conexion_bd();
            $querry = "UPDATE controlgas SET MontoGas=:monto, FechaGas=:fecha
                        WHERE IdGas=:id";
            $arre = [":id"=>$idGas, ":monto"=>$monto, ":fecha"=>$fecha];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function modificar_gasto_tipo($idGas, $gastoTipo){
            $this->conexion_bd();
            $querry = "UPDATE contipogas SET IdGasto=:idGasTipo
                        WHERE IdGas=:id";
            $arre = [":id"=>$idGas, ":idGasTipo"=>$gastoTipo];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function modificar_gasto_doc($idGas, $doc){
            $this->conexion_bd();
            $querry = "UPDATE controlgas SET DocGas=:doc
                        WHERE IdGas=:id";
            $arre = [":id"=>$idGas, ":doc"=>$doc];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function modificar_ingreso($idGas, $monto, $fecha){
            $this->conexion_bd();
            $querry = "UPDATE controlingre SET MontoIngre=:monto, FechaIngre=:fecha
                        WHERE IdIngre=:id";
            $arre = [":id"=>$idGas, ":monto"=>$monto, ":fecha"=>$fecha];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        
        public function modificar_ingreso_doc($idGas, $doc){
            $this->conexion_bd();
            $querry = "UPDATE controlingre SET DocIngre=:doc
                        WHERE IdIngre=:id";
            $arre = [":id"=>$idGas, ":doc"=>$doc];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }
    }

?>