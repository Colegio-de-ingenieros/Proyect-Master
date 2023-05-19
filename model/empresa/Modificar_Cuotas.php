<?php
    include('../../config/Crud_bd.php');

    class modificarCuotas extends Crud_bd{

        public function actualizar($idV, $tipo, $monto, $inicio, $fin){
            $this->conexion_bd();
            
            $consulta1 = "UPDATE vigenciacuotas SET MontoVigCuo=:monto, IniVigCuo=:inicio, FinVigCuo=:fin WHERE IdVigCuo=:idV";
            $parametros1 = [":idV"=>$idV, ":monto"=>$monto, ":inicio"=>$inicio, ":fin"=>$fin];
            
            $datos = $this->insertar_eliminar_actualizar($consulta1,$parametros1);
            $this->cerrar_conexion();
            return $datos;
        }

        public function usuario($correo){
            $this->conexion_bd();
            $consulta = "SELECT RFCUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }
    }
?>