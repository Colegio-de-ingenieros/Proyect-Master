<?php
    include('../../config/Crud_bd.php');

    class modificarCursos extends Crud_bd{

        public function id($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT IdPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function datosPerso($idperso, $nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fechaNac, $calle, $pasantia, $ceduperso){
            $this->conexion_bd();
            
            $consulta = "UPDATE usuaperso SET NomPerso=:nombre, ApePPerso=:paterno, ApeMPerso=:materno, CorreoPerso=:correo, CedulaPerso=:cedula, TelFPerso=:fijo, TelMPerso=:movil, 
            FechaNacPerso=:fecha, CallePerso=:calle, PasantiaPerso=:pasantia, ceduPerso=:ceduPerso WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso, ":nombre"=>$nombre, ":paterno"=>$apeP, ":materno"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":fijo"=>$telF, ":movil"=>$telM, 
            ":fecha"=>$fechaNac, ":calle"=>$calle, ":pasantia"=>$pasantia, ":ceduPerso"=>$ceduperso];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function obtener_contraseña($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT ContraPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function nueva_contraseña($idperso){
            $this->conexion_bd();
            
            $consulta = "UPDATE usuaperso SET ContraPerso=:contra WHERE WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }
    }
?>