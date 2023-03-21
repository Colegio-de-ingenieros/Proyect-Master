<?php
include('../../config/Crud_bd.php'); 

class MostrarCurso{
    private $bd;

    function BD(){
        $this->bd = new Crud_bd();
        $this->bd->conexion_bd();
    }


    //hace la consulta principal de los datos de las certificaciones
    function cursos_disponibles(){
        $consulta = "SELECT ClaveCur, NomCur, DuracionCur FROM cursos";
        $datos = $this->bd->mostrar($consulta);

        return $datos;
    }
}

$objeto = new MostrarCurso();
$objeto->BD();

?>