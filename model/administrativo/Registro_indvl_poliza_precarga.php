<?php
include('../../config/Crud_bd.php');

class Precarga{
    private $base;

    //crea un objeto del CRUD para hacer las consultas
    function conexion(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    function seleccionar_persona($id){
        $querry = "SELECT IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol FROM polgeneral
        WHERE  IdPolGral = :id";
        $parametros = [":id"=>$id];
        $resultados = $this->base->mostrar($querry, $parametros);
        return $resultados;

    }

}

?>