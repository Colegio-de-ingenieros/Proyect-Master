<?php
include('../../config/Crud_bd.php');

class ReporteGral{
    private $base;

    //crea un objeto del CRUD para hacer las consultas
    function conexion()
    {
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //obtiene los seguimientos del tipo de actividad que recibe como parametro
    function get($actividad){
        $querry = "SELECT IdSeg FROM $actividad order by IdSeg";
        //$arre = [":tabla"=>$actividad];

        $seguimientos = $this->base->mostrar($querry);

        return $seguimientos;

    }

    //busca los gastos de instructores de un curso que recibe como parametro, opcional busca entre las fechas que recibe
    function getGastosIns($ids, ?string $fechaI = null, ?string $fechaF = null){
        if($fechaI == null and $fechaF == null){
            $qGastoInstructores = "SELECT controlgas.MontoGas, tipogastos.TipoGas 
            FROM insparticipa,insgastos, controlgas, contipogas, tipogastos 
            WHERE insparticipa.idSeg = :ids AND insparticipa.IdParI = insgastos.IdParI AND 
            insgastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND 
            contipogas.IdGasto = tipogastos.IdGasto";

            $arre = [":ids" => $ids];
        }

        else{
            $qGastoInstructores = "SELECT controlgas.MontoGas, tipogastos.TipoGas 
            FROM insparticipa,insgastos, controlgas, contipogas, tipogastos 
            WHERE insparticipa.idSeg = :ids AND insparticipa.IdParI = insgastos.IdParI AND 
            insgastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND 
            contipogas.IdGasto = tipogastos.IdGasto order BY IdSeg AND controlgas.FechaGas <= :fechaF AND controlgas.FechaGas >= :fechaI";

            $arre = [":ids" => $ids, ":fechaF"=>$fechaF, ":fechaI"=>$fechaI];
        }
       

        $gastoInstructores = $this->base->mostrar($qGastoInstructores, $arre);
        return $gastoInstructores;
    }

    //busca los gastos de empresas de un seguimiento que recibe como parametro, opcional busca entre las fechas que recibe
    function getGastosEmp($ids, ?string $fechaI = null, ?string $fechaF = null)
    {
        if ($fechaI == null and $fechaF == null) {
            $qGastoInstructores = "SELECT controlgas.MontoGas, tipogastos.TipoGas
            FROM empparticipa, empgastos, controlgas, contipogas, tipogastos 
            WHERE empparticipa.IdSeg = :ids AND empparticipa.IdParE = empgastos.IdParE AND 
            empgastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND 
            contipogas.IdGasto = tipogastos.IdGasto";

            $arre = [":ids" => $ids];
        } else {
            $qGastoInstructores = "SELECT controlgas.MontoGas, tipogastos.TipoGas
            FROM empparticipa, empgastos, controlgas, contipogas, tipogastos 
            WHERE empparticipa.IdSeg = :ids AND empparticipa.IdParE = empgastos.IdParE AND 
            empgastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND 
            contipogas.IdGasto = tipogastos.IdGasto AND controlgas.FechaGas <= :fechaF AND 
            controlgas.FechaGas >= :fechaI";

            $arre = [":ids" => $ids, ":fechaF" => $fechaF, ":fechaI" => $fechaI];
        }

        $gastoEmpresas = $this->base->mostrar($qGastoInstructores, $arre);
        return $gastoEmpresas;
    }

    //busca los gastos de socios de un seguimiento que recibe como parametro, opcional busca entre las fechas que recibe
    function getGastosPerso($ids, ?string $fechaI = null, ?string $fechaF = null)
    {
        if ($fechaI == null and $fechaF == null) {
            $qGastoPersonas = "SELECT controlgas.MontoGas, tipogastos.TipoGas
            FROM persoparticipa, persogastos, controlgas, contipogas, tipogastos 
            WHERE persoparticipa.IdSeg = :ids AND persoparticipa.IdParP = persogastos.IdParP AND 
            persogastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND 
            contipogas.IdGasto = tipogastos.IdGasto";

            $arre = [":ids" => $ids];
        } else {
            $qGastoPersonas = "SELECT controlgas.MontoGas, tipogastos.TipoGas
            FROM persoparticipa, persogastos, controlgas, contipogas, tipogastos 
            WHERE persoparticipa.IdSeg = :ids AND persoparticipa.IdParP = persogastos.IdParP AND 
            persogastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND 
            contipogas.IdGasto = tipogastos.IdGasto AND controlgas.FechaGas <= :fechaF AND 
            controlgas.FechaGas >= :fechaI";

            $arre = [":ids" => $ids, ":fechaF" => $fechaF, ":fechaI" => $fechaI];
        }

        $gastoPersonas = $this->base->mostrar($qGastoPersonas, $arre);
        return $gastoPersonas;
    }

    //busca los ingresos de socios de un seguimiento que recibe como parametro, opcional busca entre las fechas que recibe
    function getIngresosPerso($ids, ?string $fechaI = null, ?string $fechaF = null)
    {
        if ($fechaI == null and $fechaF == null) {
            $qIngrePersonas = "SELECT SUM(controlingre.MontoIngre) as total FROM persoparticipa, persoingresos, controlingre
            WHERE persoparticipa.IdSeg = :ids AND persoparticipa.IdParP = persoingresos.IdParP AND 
            persoingresos.IdIngre = controlingre.IdIngre";

            $arre = [":ids" => $ids];
        } else {
            $qIngrePersonas = "SELECT SUM(controlingre.MontoIngre) as total FROM persoparticipa, persoingresos, controlingre
            WHERE persoparticipa.IdSeg = :ids AND persoparticipa.IdParP = persoingresos.IdParP AND 
            persoingresos.IdIngre = controlingre.IdIngre AND controlingre.FechaIngre <= :fechaF AND 
            controlingre.FechaIngre >= :fechaI";

            $arre = [":ids" => $ids, ":fechaF" => $fechaF, ":fechaI" => $fechaI];
        }

        $ingrePersonas = $this->base->mostrar($qIngrePersonas, $arre);
        return $ingrePersonas;
    }

    //busca los ingresos de empresas de un seguimiento que recibe como parametro, opcional busca entre las fechas que recibe
    function getIngresosEmpresa($ids, ?string $fechaI = null, ?string $fechaF = null)
    {
        if ($fechaI == null and $fechaF == null) {
            $qIngreEmpresa = "SELECT SUM(controlingre.MontoIngre) as total FROM empparticipa, empingresos, controlingre
            WHERE empparticipa.IdSeg = :ids AND empparticipa.IdParE = empingresos.IdParE AND 
            empingresos.IdIngre = controlingre.IdIngre";

            $arre = [":ids" => $ids];
        } else {
            $qIngreEmpresa = "SELECT SUM(controlingre.MontoIngre) as total FROM empparticipa, empingresos, controlingre
            WHERE empparticipa.IdSeg = :ids AND empparticipa.IdParE = empingresos.IdParE AND 
            empingresos.IdIngre = controlingre.IdIngre AND controlingre.FechaIngre <= :fechaF AND 
            controlingre.FechaIngre >= :fechaI";

            $arre = [":ids" => $ids, ":fechaF" => $fechaF, ":fechaI" => $fechaI];
        }

        $ingreEmpresa = $this->base->mostrar($qIngreEmpresa, $arre);
        return $ingreEmpresa;
    }

    //busca los ingresos de instructores de un seguimiento que recibe como parametro, opcional busca entre las fechas que recibe
    function getIngresosInst($ids, ?string $fechaI = null, ?string $fechaF = null)
    {
        if ($fechaI == null and $fechaF == null) {
            $qIngreInst = "SELECT SUM(controlingre.MontoIngre) as total FROM insparticipa, insingresos, controlingre
            WHERE insparticipa.IdSeg = :ids AND insparticipa.IdParI = insingresos.IdParI AND 
            insingresos.IdIngre = controlingre.IdIngre";

            $arre = [":ids" => $ids];
        } else {
            $qIngreInst = "SELECT SUM(controlingre.MontoIngre) as total FROM insparticipa, insingresos, controlingre
            WHERE insparticipa.IdSeg = :ids AND insparticipa.IdParI = insingresos.IdParI AND 
            empingresos.IdIngre = controlingre.IdIngre AND controlingre.FechaIngre <= :fechaF AND 
            controlingre.FechaIngre >= :fechaI";

            $arre = [":ids" => $ids, ":fechaF" => $fechaF, ":fechaI" => $fechaI];
        }

        $ingreIns = $this->base->mostrar($qIngreInst, $arre);
        return $ingreIns;
    }   

    function getNombres($ids, $tipo){
        if($tipo == 'cursos'){
            $querry = "SELECT cursos.NomCur as nombre FROM segcursos, cursos
            WHERE cursos.ClaveCur = segcursos.ClaveCur AND segcursos.IdSeg = :ids";
        }

        else if($tipo == 'proyectos'){
            $querry = "SELECT proyectos.NomProyecto as nombre FROM segproyectos, proyectos
            WHERE proyectos.IdPro = segproyectos.IdPro AND segproyectos.IdSeg = :ids";
        }

        else if($tipo == 'certificaciones'){
            $querry = "SELECT certinterna.NomCertInt as nombre FROM segcertint, certinterna
            WHERE certinterna.IdCerInt = segcertint.IdCerInt AND segcertint.IdSeg = :ids";
        }

        $arre = [":ids"=>$ids];

        $nom = $this->base->mostrar($querry, $arre);

        return $nom;

    }
}
?>