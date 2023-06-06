<?php
include('../../config/Crud_bd.php'); 

class MostrarEmpresa{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    echo "hola";
}
$obj = new MostrarOfertas();
$obj->instancias();
?>