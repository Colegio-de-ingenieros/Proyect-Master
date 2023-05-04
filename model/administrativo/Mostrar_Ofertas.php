<?php
include('../../config/Crud_bd.php'); 

class MostrarOfertas{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    //hace la consulta principal de los datos de las certificaciones
    function getOfertas($rfc){
        $querry = "SELECT bolsaempresa.IdEmpBol, VacEmpBol, ReqAcaEmpBol, AñoEmpBol,TelEmpBol, DesEmpBol, TipoMod 
        FROM bolsaempresa, usuaempbolsa,bolsamodalidades,modalidad
        WHERE bolsaempresa.IdEmpBol=usuaempbolsa.IdEmpBol and bolsaempresa.IdEmpBol=bolsamodalidades.IdEmpBol and bolsamodalidades.IdMod=modalidad.IdMod and usuaempbolsa.RFCUsuaEmp=:rfc
        ORDER BY VacEmpBol ASC";
        $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);

}
function buscadorOfertas($rfc,$busqueda){
    $querry = "SELECT bolsaempresa.IdEmpBol, VacEmpBol, ReqAcaEmpBol, AñoEmpBol,TelEmpBol, DesEmpBol, TipoMod 
    FROM bolsaempresa, usuaempbolsa,bolsamodalidades,modalidad
    WHERE bolsaempresa.IdEmpBol=usuaempbolsa.IdEmpBol and bolsaempresa.IdEmpBol=bolsamodalidades.IdEmpBol and bolsamodalidades.IdMod=modalidad.IdMod and usuaempbolsa.RFCUsuaEmp=:rfc
    ORDER BY VacEmpBol ASC";
    $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);

}
}
$obj = new MostrarOfertas();
$obj->instancias();
?>