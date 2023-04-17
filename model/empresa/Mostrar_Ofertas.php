<?php
include('../../config/Crud_bd.php'); 

class MostrarOfertas{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    //hace la consulta principal de los datos de las certificaciones
    function getOfertas(){
        $querry = "SELECT IdEmpBol, VacEmpBol, ReqAcaEmpBol, AñoEmpBol,TelEmpBol FROM bolsaempresa";
        $resultados = $this->base->mostrar($querry);

        return $resultados;
    }

    function buscador($busqueda){
        $querry = "SELECT IdEmpBol, VacEmpBol, ReqAcaEmpBol, AñoEmpBol,TelEmpBol FROM bolsaempresa 
        WHERE VacEmpBol LIKE :busqueda OR TelEmpBol LIKE :busqueda";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);

        return $resultados;
    }
}

$obj = new MostrarOfertas();
$obj->instancias();
?>