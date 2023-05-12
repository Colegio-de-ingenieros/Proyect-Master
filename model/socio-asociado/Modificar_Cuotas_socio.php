<?php
    include('../../config/Crud_bd.php');

    class modificarCuotas extends Crud_bd{

        public function actualizar($idV, $tipo, $monto, $inicio, $fin, $doc){
            $this->conexion_bd();

            $consulta = "UPDATE tipovigcuota SET IdCuota=:nombre WHERE IdVigCuo=:idV";
            $parametros = [":idV"=>$idV, ":nombre"=>$tipo];
            
            $consulta1 = "UPDATE vigenciacuotas SET MontoVigCuo=:monto, IniVigCuo=:inicio, FinVigCuo=:fin, DocCuota=:doc WHERE IdVigCuo=:idV";
            $parametros1 = [":idV"=>$idV, ":monto"=>$monto, ":inicio"=>$inicio, ":fin"=>$fin, ":doc"=>$doc];
            
            $consul=[$consulta, $consulta1];
            $para=[$parametros, $parametros1];
            
            $datos = $this->insertar_eliminar_actualizar($consul,$para);
            $this->cerrar_conexion();
            return $datos;
        }
    }
?>