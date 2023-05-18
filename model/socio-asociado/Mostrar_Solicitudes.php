<?php
include('../../config/Crud_bd.php'); 

class MostrarSolicitud{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    function getId($correo){
        $querry = "SELECT IdPerso FROM usuaperso WHERE CorreoPerso = :correo";
        $resultados = $this->base->mostrar($querry, [":correo" => $correo]);
        
        return $resultados;
    }
    function getCv($id){
        $querry = "SELECT * FROM persobolsacv WHERE IdPerso = :id";
        $resultados = $this->base->mostrar($querry, [":id" => $id]);
        
        return $resultados;
    }
    function busquedaSolicitud($busqueda, $socio){
        $querry = "SELECT NomUsuaEmp,bolsaempresa.IdEmpBol, VacEmpBol, DesEmpBol
        FROM bolsaempresa, usuaempbolsa, bolsaempcv,usuaemp
        WHERE usuaemp.RFCUsuaEmp=usuaempbolsa.RFCUsuaEmp AND bolsaempresa.IdEmpBol=usuaempbolsa.IdEmpBol 
        AND bolsaempcv.IdEmpBol=usuaempbolsa.IdEmpBol AND IdBolCv = :id 
        AND (NomUsuaEmp LIKE :busqueda OR VacEmpBol LIKE :busqueda)";
        $resultados = $this->base->mostrar($querry, [":id" => $socio, ":busqueda" => "%".$busqueda."%"]);
        return $resultados;
    }

    function mostrar($socio){
        $querry = "SELECT NomUsuaEmp,bolsaempresa.IdEmpBol, VacEmpBol, ReqAcaEmpBol, AñoEmpBol,TelEmpBol, DesEmpBol
        FROM bolsaempresa, usuaempbolsa, bolsaempcv,usuaemp
        WHERE usuaemp.RFCUsuaEmp=usuaempbolsa.RFCUsuaEmp AND bolsaempresa.IdEmpBol=usuaempbolsa.IdEmpBol 
        AND bolsaempcv.IdEmpBol=usuaempbolsa.IdEmpBol AND IdBolCv = :id";
        $resultados = $this->base->mostrar($querry, [":id" => $socio]);
        return $resultados;
    }


}