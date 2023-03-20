<?php
include('../../config/Crud_bd.php'); 

class MostrarCertificaciones{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }


    //hace la consulta principal de los datos de las certificaciones
    function getProyectos(){
        $querry = "SELECT NomProyecto, IniPro, FinPro, MontoPro, ObjPro FROM proyectos";
        $resultados = $this->base->mostrar($querry);

        return $resultados;
    }
}

$obj = new MostrarCertificaciones();
$obj->instancias();

?>