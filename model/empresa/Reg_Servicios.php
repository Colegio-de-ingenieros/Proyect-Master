<?php
    include('../../config/Crud_bd.php');

    class funciones_servicios{
        private $bd;

        function BD(){
            $this -> bd = new Crud_bd();
            $this -> bd -> conexion_bd();
        }

        function get_rfc($correo){
            $consulta = "SELECT RFCUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $resultados = $this -> bd -> mostrar($consulta,$parametros);
            return $resultados;
        }

        function get_id_servicio(){
            $consulta = "SELECT IdSer FROM servicios ORDER BY IdSer DESC LIMIT 1";
            $resultados = $this -> bd -> mostrar($consulta);
            
            return $resultados;
        }

        function registrar_servicio_headhunter($id_servicio, $rfc_empresa, $fecha, $estatus){
            //* Registrar en la tabla servicios
            $consulta = "INSERT INTO servicios(IdSer, FechaSer, EstatusSer) VALUES (:id, :fecha, :estatus)";
            $parametros = [":id" => $id_servicio, ":fecha" => $fecha, ":estatus" => $estatus];
            $this -> bd -> insertar_eliminar_actualizar($consulta, $parametros);

            //* Registrar en la tabla sertipo
            $consulta = "INSERT INTO sertipo(IdSer, IdTipoSer) VALUES (:id,:tipo)";
            $parametros = [":id" => $id_servicio, ":tipo" => 1];
            $this -> bd -> insertar_eliminar_actualizar($consulta, $parametros);

            //* Registrar en la tabla empservicios
            $consulta = "INSERT INTO `empservicios` (`RFCUsuaEmp`, `IdSer`) VALUES (:id, :servicio);";
            $parametros = [":id" => $rfc_empresa, ":servicio" => $id_servicio];
            $this -> bd -> insertar_eliminar_actualizar($consulta, $parametros);

            return "Servicio headhunter registrado con éxito";
        }
        
        function registrar_servicio_outplacement($id_servicio, $rfc_empresa, $fecha, $estatus){
            //* Registrar en la tabla servicios
            $consulta = "INSERT INTO servicios(IdSer, FechaSer, EstatusSer) VALUES (:id,:fecha,:estatus)";
            $parametros = [":id"=>$id_servicio,":fecha"=>$fecha,":estatus"=>$estatus];
            $this -> bd -> insertar_eliminar_actualizar($consulta,$parametros);

            //* Registrar en la tabla sertipo
            $consulta = "INSERT INTO sertipo(IdSer, IdTipoSer) VALUES (:id,:tipo)";
            $parametros = [":id"=>$id_servicio,":tipo"=>2];
            $this -> bd -> insertar_eliminar_actualizar($consulta,$parametros);

            //* Registrar en la tabla empservicios
            $consulta = "INSERT INTO empservicios(RFCUsuaEmp, IdSer) VALUES (:id,:servicio)";
            $parametros = [":id"=>$rfc_empresa,":servicio"=>$id_servicio];
            $this -> bd -> insertar_eliminar_actualizar($consulta,$parametros);

            return "Servicio outplacement registrado con éxito";
        }
    }
?>