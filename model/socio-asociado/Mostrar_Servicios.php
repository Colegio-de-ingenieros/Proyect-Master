<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Servicios{
        private $bd;

        function BD(){
            $this->bd = new Crud_bd();
            $this->bd->conexion_bd();
        }

        function datos_usuario($tipo, $correo){
            if ($tipo == 'socio'){
                $consulta = "SELECT IdPerso,NomPerso,ApePPerso,ApeMPerso,FechaNacPerso,CorreoPerso,TelFPerso,TelMPerso,CallePerso
                FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
                $parametros = [":user"=>$correo];
                $resultados = $this->bd->mostrar($consulta,$parametros);
                return $resultados;
            }
        }

        function servicios_solicitados($id){
            $consulta = "SELECT tiposervicios.TipoSer, DATE_FORMAT(servicios.FechaSer,'%d/%m/%Y') AS FechaSer, servicios.EstatusSer, servicios.IdSer 
            FROM persoservicios, servicios, sertipo, tiposervicios 
            WHERE persoservicios.NumInteligente = :id 
            AND persoservicios.IdSer = servicios.IdSer 
            AND servicios.IdSer = sertipo.IdSer 
            AND sertipo.IdTipoSer = tiposervicios.IdTipoSer";
            $parametros = [":id"=>$id];
            $resultados = $this->bd->mostrar($consulta,$parametros);
            
            return $resultados;
        }

        function cancelar_servicio($id){
            $consulta = "UPDATE servicios SET EstatusSer = '3' WHERE IdSer = :id";
            $parametros = [":id"=>$id];
            $this->bd->insertar_eliminar_actualizar($consulta,$parametros);
            
            return "Servicio cancelado";
        }
    }
?>