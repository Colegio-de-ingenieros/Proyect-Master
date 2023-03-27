<?php
include('../../config/Crud_bd.php'); 

class MostrarTrabajadores{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    //hace la consulta principal de los datos de las certificaciones
    function getTrabajadores(){
        $querry = "SELECT * FROM trabajadores";
        $resultados = $this->base->mostrar($querry);

        return $resultados;
    }
}

$obj = new MostrarTrabajadores();
$obj->instancias();
?>