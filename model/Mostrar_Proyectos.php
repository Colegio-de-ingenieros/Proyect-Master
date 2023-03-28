<?php
include('../../config/Crud_bd.php'); 

class MostrarProyectos{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }


    //hace la consulta principal de los datos de los proyectos
    function getProyectos(){
        $querry = "SELECT NomProyecto, MontoPro, ObjPro FROM proyectos";
        $resultados = $this->base->mostrar($querry);

        return $resultados;
    }
    function getIniPro(){
        $querry1 = "SELECT DATE_FORMAT(IniPro, '%d/%m/%Y') IniPro  FROM proyectos";
        $resultados1 = $this->base->mostrar($querry1);

        return $resultados1;
    }
    function getFinPro(){
        $querry2 = "SELECT DATE_FORMAT(FinPro, '%d/%m/%Y') FinPro  FROM proyectos";
        $resultados2 = $this->base->mostrar($querry2);

        return $resultados2;
    }
}

?>