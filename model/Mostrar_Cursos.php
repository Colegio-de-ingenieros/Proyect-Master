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
    function buscar($busqueda){
        $querry = "SELECT * FROM cursos WHERE NomCur LIKE :busqueda OR ClaveCur LIKE :busqueda OR DuracionCur <= :busqueda";
        $resultados = $this->bd->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);

        return $resultados;
    }
}

$objeto = new MostrarCurso();
$objeto->BD();

?>