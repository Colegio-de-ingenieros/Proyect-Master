<?php
    include('../../config/Crud_bd.php');

    class modificarCuotas extends Crud_bd{

        public function actualizar($idV, $tipo, $monto, $inicio, $fin, $doc){
            $this->conexion_bd();
            
            $consulta1 = "UPDATE vigenciacuotas SET MontoVigCuo=:monto, IniVigCuo=:inicio, FinVigCuo=:fin, DocCuota=:doc WHERE IdVigCuo=:idV";
            $parametros1 = [":idV"=>$idV, ":monto"=>$monto, ":inicio"=>$inicio, ":fin"=>$fin, ":doc"=>$doc];
            
            $datos = $this->insertar_eliminar_actualizar($consulta1,$parametros1);
            $this->cerrar_conexion();
            return $datos;
        }
    }
?>