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
    function mostrarOferta($id){
        //echo $id;
        $querry = "SELECT * FROM bolsaempresa 
        WHERE IdEmpBol = :id";
        $resultados = $this->base->mostrar($querry, [":id" => $id]);
        return $resultados;
    }
    function mostrarJornada($id){
        $q1 = "SELECT * FROM `jornada`,`bolsajornada` 
        WHERE `jornada`.IdJor=`bolsajornada`.`IdJor` 
        AND `bolsajornada`.`IdEmpBol`=:id";
        $resultados2 = $this->base->mostrar($q1, [":id" => $id]);
        return $resultados2;
    }
    function mostrarModalidad($id){
        $q2 = "SELECT * FROM `modalidad`,`bolsamodalidades` 
        WHERE `bolsamodalidades`.`IdMod`=`modalidad`.`IdMod` 
        AND `bolsamodalidades`.`IdEmpBol`= :id";
        $resultados3 = $this->base->mostrar($q2, [":id" => $id]);
        return $resultados3;
    }
    function mostrarColonia($id){
        $q3 = "SELECT * FROM `colonias`,`bolsacvlugares` ,`municipios`, `estados` 
        WHERE `bolsacvlugares`.`IdColonia`=`colonias`.`IdColonia` 
        AND `colonias`.`idmunicipio`= `municipios`.`idmunicipio` 
        AND `municipios`.`idestado` = `estados`.`idestado` 
        AND `bolsacvlugares`.`IdEmpBol`= :id";
        $resultados4 = $this->base->mostrar($q3, [":id" => $id]);
        return $resultados4;
    }
}

$obj = new MostrarOfertas();
$obj->instancias();
?>