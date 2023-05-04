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
        $querry = "SELECT bolsaempresa.IdEmpBol, VacEmpBol, ReqAcaEmpBol, AñoEmpBol,TelEmpBol, DesEmpBol, TipoMod, EstatusEmpBol 
        FROM bolsaempresa, usuaempbolsa,bolsamodalidades,modalidad
        WHERE bolsaempresa.IdEmpBol=usuaempbolsa.IdEmpBol and bolsaempresa.IdEmpBol=bolsamodalidades.IdEmpBol and bolsamodalidades.IdMod=modalidad.IdMod and usuaempbolsa.RFCUsuaEmp=:rfc
        ORDER BY VacEmpBol ASC";
        $resultados = $this->base->mostrar($querry, [":rfc" => $rfc]);

        return $resultados;
    }
    function rfccorreo($correo){
        $querry = "SELECT RFCUsuaEmp FROM usuaemp WHERE CorreoUsuaEmp = :correo";
        $resultados = $this->base->mostrar($querry, [":correo" => $correo]);
        return $resultados;
    }
    function buscador($busqueda,$rfce){
        
        $querry = "SELECT RFCUsuaEmp,bolsaempresa.IdEmpBol, VacEmpBol, ReqAcaEmpBol, AñoEmpBol,TelEmpBol, DesEmpBol, TipoMod, TipoJor, EstatusEmpBol
        FROM bolsaempresa, usuaempbolsa,bolsamodalidades,modalidad, bolsajornada, jornada
        WHERE (bolsaempresa.IdEmpBol=usuaempbolsa.IdEmpBol and bolsaempresa.IdEmpBol=bolsamodalidades.IdEmpBol and bolsamodalidades.IdMod=modalidad.IdMod and bolsaempresa.IdEmpBol=bolsajornada.IdEmpBol 
        and bolsajornada.IdJor=jornada.IdJor and usuaempbolsa.RFCUsuaEmp=:rfc)
        and (TipoMod LIKE :busqueda OR ReqAcaEmpBol LIKE :busqueda OR ReqTecEmpBol LIKE :busqueda OR VacEmpBol LIKE :busqueda OR AñoEmpBol LIKE :busqueda)
        order by VacEmpBol ASC";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$busqueda."%",":rfc" => $rfce]);

        return $resultados;
    }
    function buscadorAplicante($buscar,$id){
        $querry = "SELECT * FROM bolsaempcv, bolsaempresa
        WHERE bolsaempresa.VacEmpBol LIKE :busqueda OR TelEmpBol LIKE :busqueda AND bolsaempresa.IdEmpBol = :id";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$buscar."%",":id" => $id]);

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
    function contar($id){
        $q4 = "SELECT COUNT(*) AS total 
        FROM `bolsaempcv`,bolsacv
        WHERE bolsaempcv.IdBolCv=bolsacv.IdBolCv AND `IdEmpBol`= :id  AND `EstatusCv` = 1";
        $resultados5 = $this->base->mostrar($q4, [":id" => $id]);
        return $resultados5;
    }
    function mostrarAplicantes($id){
        $q4 = "SELECT * 
        FROM `bolsaempcv`
        WHERE `IdEmpBol`= :id";
        $resultados5 = $this->base->mostrar($q4, [":id" => $id]);
        return $resultados5;
    }
    function getAplicante($id){
        $q4 = "SELECT * 
        FROM `bolsaempcv`
        WHERE `IdEmpBol`= :id";
        $resultados5 = $this->base->mostrar($q4, [":id" => $id]);
        return $resultados5;
    }
    function getDias($id){
        $q4 = "SELECT Dia FROM empboldias,diaslaborales
        WHERE empboldias.IdLab=diaslaborales.IdLab and`IdEmpBol`= :id";
        $resultados5 = $this->base->mostrar($q4, [":id" => $id]);
        return $resultados5;
    }

}

$obj = new MostrarOfertas();
$obj->instancias();
?>