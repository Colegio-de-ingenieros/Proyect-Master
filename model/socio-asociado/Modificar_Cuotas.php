<?php
    include('../../config/Crud_bd.php');

    class modificarCuotas extends Crud_bd{

        public function actualizar($idV, $monto, $inicio, $fin, $tipo, $sta, $com){
            $this->conexion_bd();
            
            $consulta1 = "UPDATE vigenciacuotas SET MontoVigCuo=:monto, IniVigCuo=:inicio, FinVigCuo=:fin, 
            EstatusVigCuo=:sta, ComeVigCuo=:com WHERE IdVigCuo=:idV";
            $parametros1 = [":idV"=>$idV, ":monto"=>$monto, ":inicio"=>$inicio, ":fin"=>$fin, ":sta"=>$sta, ":com"=>$com];

            $consulta = "UPDATE tipovigcuota SET IdCuota=:tipo WHERE IdVigCuo=:idV";
            $parametros = [":idV"=>$idV, ":tipo"=>$tipo];
            $consul=[$consulta1, $consulta];
            $para=[$parametros1, $parametros];
            
            $datos = $this->insertar_eliminar_actualizar($consul,$para);
            $this->cerrar_conexion();
            return $datos;
        }

        public function usuario($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT IdPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function id_cuotas($id){
            $this->conexion_bd();
    
            $consulta = "SELECT IdVigCuo FROM persovigcuota WHERE IdPerso =  :user";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

    }
?>