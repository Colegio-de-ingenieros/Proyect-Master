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
        $querry = "SELECT * FROM trabajadores, tratipousua WHERE trabajadores.RFCT = tratipousua.RFCT and IdUsua=4";
        $resultados = $this->base->mostrar($querry);
        
        return $resultados;
    }
    function getTrabajadoresRFC($rfc){
        $querry = "SELECT * FROM trabajadores WHERE RFCT = :rfc";
        $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);

        return $resultados;
    }
    function buscador($busqueda){
        $querry = "SELECT * FROM trabajadores , tratipousua
        WHERE trabajadores.RFCT = tratipousua.RFCT and IdUsua=4 AND (trabajadores.RFCT LIKE :busqueda OR NombreT LIKE :busqueda OR ApePT LIKE :busqueda OR ApeMT LIKE :busqueda OR CorreoT LIKE :busqueda)";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);

        return $resultados;
    }
}

$obj = new MostrarTrabajadores();
$obj->instancias();
?>