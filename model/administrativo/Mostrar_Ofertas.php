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
        $querry = "SELECT NomUsuaEmp,VacEmpBol, EstatusEmpBol, bolsaempresa.IdEmpBol
        FROM usuaemp, usuaempbolsa, bolsaempresa
        WHERE usuaemp.RFCUsuaEmp = usuaempbolsa.RFCUsuaEmp  and bolsaempresa.IdEmpBol = usuaempbolsa.IdEmpBol
        ORDER BY NomUsuaEmp ASC";
        $resultados = $this->base->mostrar($querry);
        return $resultados;

}
function buscadorOfertas($busqueda){
    $querry = "SELECT NomUsuaEmp,VacEmpBol, EstatusEmpBol, bolsaempresa.IdEmpBol
    FROM usuaemp, usuaempbolsa, bolsaempresa
    WHERE usuaemp.RFCUsuaEmp = usuaempbolsa.RFCUsuaEmp  and bolsaempresa.IdEmpBol = usuaempbolsa.IdEmpBol
    AND (NomUsuaEmp LIKE :busqueda OR VacEmpBol LIKE :busqueda)
    ORDER BY NomUsuaEmp ASC";
    $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);

}
}
$obj = new MostrarOfertas();
$obj->instancias();
?>