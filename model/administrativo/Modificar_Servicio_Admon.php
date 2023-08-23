<?php
    include('../../config/Crud_bd.php');
    class ModSer{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }
        function modificar($id,$valor){
            $q1="UPDATE servicios SET EstatusSer=:valor WHERE IdSer = :id";
            $a1 = [":valor"=>$valor, ":id"=>$id];
            $querry = [$q1];
            $arre = [$a1];
            $this->base->insertar_eliminar_actualizar($querry, $arre);
        }
        function headhunter($valor){
            $sql = "SELECT servicios.IdSer
            FROM usuaperso,persoservicios,servicios,sertipo,tiposervicios
            WHERE usuaperso.IdPerso = persoservicios.NumInteligente 
            and persoservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Headhunter'
            and usuaperso.IdPerso = :busqueda";

            $arre = [":busqueda"=>$valor];
            $resultados = $this->base->mostrar($sql, $arre);

            return $resultados;
        }

        function outplacement($valor){
            $sql = "SELECT servicios.IdSer
            FROM usuaemp,empservicios,servicios,sertipo,tiposervicios
            WHERE usuaemp.RFCUsuaEmp = empservicios.RFCUsuaEmp  
            and empservicios.IdSer = servicios.IdSer
            and servicios.IdSer = sertipo.IdSer
            and sertipo.IdTipoSer = tiposervicios.IdTipoSer
            and tiposervicios.TipoSer = 'Outplacement'
            and usuaemp.RFCUsuaEmp = :busqueda";

            $arre = [":busqueda"=>$valor];
            $resultados = $this->base->mostrar($sql, $arre);
            return $resultados;
        }
    }
?>