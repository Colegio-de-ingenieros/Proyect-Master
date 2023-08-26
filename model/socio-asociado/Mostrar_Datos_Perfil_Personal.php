<?php
    include('../../config/Crud_bd.php');

    class mostrarDatosPersonales extends Crud_bd{

        public function datos_personales($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT IdPerso, NomPerso, ApePPerso, ApeMPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, ceduPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function domicilio($id){
            $this->conexion_bd();
            
            $consulta = "SELECT persolugares.IdColonia, colonias.codpostal  FROM  persolugares INNER JOIN colonias 
            on persolugares.IdColonia = colonias.IdColonia and IdPerso = :user";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function estudios($id){
            $this->conexion_bd();
            $consulta = "SELECT IdGrado FROM persoestudios WHERE IdPerso=:user";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }
    }
?>