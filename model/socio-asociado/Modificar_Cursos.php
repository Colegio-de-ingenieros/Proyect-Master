<?php
    include('../../config/Crud_bd.php');

    class modificarCursos extends Crud_bd{

        public function actualizar($idc, $nombre, $hra, $org, $sta, $com){
            $this->conexion_bd();
            
            $consulta = "UPDATE altacursos SET NomCurPerso=:nombre, HraCurPerso=:hra, OrgCurPerso=:org, 
            EstatusCurPerso=:sta, ComeCurPerso=:com WHERE IdCurPerso=:idc";
            $parametros = [":idc"=>$idc, ":nombre"=>$nombre, ":hra"=>$hra, ":org"=>$org, ":sta"=>$sta, ":com"=>$com];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
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
    }
?>