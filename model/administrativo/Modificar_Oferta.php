<?php
    include('../../config/Crud_bd.php');
    class ModOferta{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }
        function modificar($id,$comentario,$valor){
            $q1="UPDATE bolsaempresa SET  ComeEmpBol = :comentario, EstatusEmpBol=:valor WHERE IdEmpBol = :id";
            $a1 = [":comentario"=>$comentario, ":valor"=>$valor, ":id"=>$id];
            $querry = [$q1];
            $arre = [$a1];
            $this->base->insertar_eliminar_actualizar($querry, $arre);
        }
    }