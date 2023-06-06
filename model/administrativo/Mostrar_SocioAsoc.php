<?php
    include('../../config/Crud_bd.php');

    class Mostrar_SocioAsoc extends Crud_bd{
        public function get_datos($idP){
            $this->conexion_bd();
            $sql = "SELECT  NomPerso, ApePPerso, ApeMPerso,DATE_FORMAT(FechaNacPerso, '%d/%m/%Y')FechaNacPerso,TelFPerso,TelMPerso,CorreoPerso,CedulaPerso, CallePerso
                    FROM usuaperso WHERE IdPerso = :idP";
            $arre = [":idP"=>$idP];
            $resultado = $this->mostrar($sql,$arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function get_direccion($idP){
            $this->conexion_bd();
            $sql = "SELECT codpostal, nomcolonia, nommunicipio, nomestado
                    FROM persolugares, colonias, municipios, estados
                    WHERE persolugares.IdColonia=colonias.IdColonia and colonias.idmunicipio=municipios.idmunicipio
                    and municipios.idestado=estados.idestado and  persolugares.IdPerso = :idP";
            $arre = [":idP"=>$idP];
            $resultado = $this->mostrar($sql,$arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function get_estudios($idP){
            $this->conexion_bd();
            $sql = "SELECT TipoGrado
                    FROM persoestudios, gradoestudios 
                    WHERE persoestudios.IdGrado=gradoestudios.IdGrado and  persoestudios.IdPerso = :idP";
            $arre = [":idP"=>$idP];
            $resultado = $this->mostrar($sql,$arre);
            $this->cerrar_conexion();
            return $resultado;
        }
        

    }

?>