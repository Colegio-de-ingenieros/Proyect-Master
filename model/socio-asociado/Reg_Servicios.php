<?php
    include('../../config/Crud_bd.php');

    class funciones_servicios{
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

        function get_id_servicio(){
            $consulta = "SELECT IdSer FROM servicios ORDER BY IdSer DESC LIMIT 1";
            $resultados = $this->bd->mostrar($consulta);
            
            return $resultados;
        }

        function registrar_servicio_headhunter($id_servicio, $id_usuario, $fecha, $estatus){
            //* Registrar en la tabla servicios
            $consulta = "INSERT INTO servicios(IdSer, FechaSer, EstatusSer) VALUES (:id,:fecha,:estatus)";
            $parametros = [":id"=>$id_servicio,":fecha"=>$fecha,":estatus"=>$estatus];
            $this->bd->insertar_eliminar_actualizar($consulta,$parametros);

            //* Registrar en la tabla sertipo
            $consulta = "INSERT INTO sertipo(IdSer, IdTipoSer) VALUES (:id,:tipo)";
            $parametros = [":id"=>$id_servicio,":tipo"=>1];
            $this->bd->insertar_eliminar_actualizar($consulta,$parametros);

            //* Registrar en la tabla persoservicios
            $consulta = "INSERT INTO persoservicios(NumInteligente, IdSer) VALUES (:id,:servicio)";
            $parametros = [":id"=>$id_usuario,":servicio"=>$id_servicio];
            $this->bd->insertar_eliminar_actualizar($consulta,$parametros);

            return "Servicio headhunter registrado con éxito";
        }
        
        function registrar_servicio_outplacement($id_servicio, $id_usuario, $fecha, $estatus){
            //* Registrar en la tabla servicios
            $consulta = "INSERT INTO servicios(IdSer, FechaSer, EstatusSer) VALUES (:id,:fecha,:estatus)";
            $parametros = [":id"=>$id_servicio,":fecha"=>$fecha,":estatus"=>$estatus];
            $this->bd->insertar_eliminar_actualizar($consulta,$parametros);

            //* Registrar en la tabla sertipo
            $consulta = "INSERT INTO sertipo(IdSer, IdTipoSer) VALUES (:id,:tipo)";
            $parametros = [":id"=>$id_servicio,":tipo"=>2];
            $this->bd->insertar_eliminar_actualizar($consulta,$parametros);

            //* Registrar en la tabla persoservicios
            $consulta = "INSERT INTO persoservicios(NumInteligente, IdSer) VALUES (:id,:servicio)";
            $parametros = [":id"=>$id_usuario,":servicio"=>$id_servicio];
            $this->bd->insertar_eliminar_actualizar($consulta,$parametros);

            return "Servicio outplacement registrado con éxito";
        }
    }
?>