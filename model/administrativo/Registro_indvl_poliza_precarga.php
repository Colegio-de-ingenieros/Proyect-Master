<?php
include('../../config/Crud_bd.php');

class Precarga{
    private $base;

    //crea un objeto del CRUD para hacer las consultas
    function conexion(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    function seleccionar_persona($id){
        $querry = "SELECT IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, 
        DATE_FORMAT(FechaPolGral, '%d/%m/%Y')FechaPolGral, CoceptoGral
        FROM polgeneral
        WHERE  IdPolGral = :id";
        $parametros = [":id"=>$id];
        $resultados = $this->base->mostrar($querry, $parametros);
        return $resultados;

    }
    function persona($id){
        $querry = "SELECT usuaperso.NomPerso,usuaperso.ApePPerso,usuaperso.ApeMPerso, tipousua.TipoU
        FROM polgeneral,persogralpol,usuaperso, persotipousua, tipousua
        WHERE  polgeneral.IdPolGral = :id
        AND polgeneral.IdPolGral = persogralpol.IdPolGral
        AND persogralpol.IdPerso = usuaperso.IdPerso
        AND usuaperso.IdPerso = persotipousua.IdPerso
        AND persotipousua.IdUsua = tipousua.IdUsua";
        $parametros = [":id"=>$id];
        $resultados = $this->base->mostrar($querry, $parametros);
        return $resultados;
    }
    function empresa($id){
        $querry = "SELECT usuaemp.NomUsuaEmp
        FROM polgeneral,empgralpol,usuaemp
        WHERE  polgeneral.IdPolGral = :id
        AND polgeneral.IdPolGral = empgralpol.IdPolGral
        AND empgralpol.RFCUsuaEmp = usuaemp.RFCUsuaEmp";
        $parametros = [":id"=>$id];
        $resultados = $this->base->mostrar($querry, $parametros);
        return $resultados;
    }

    function cursos($id){
        $querry = "SELECT cursos.NomCur
        FROM cursos, cursoserpol, polgeneral
        WHERE  polgeneral.IdPolGral = :id
        AND polgeneral.IdPolGral = cursoserpol.IdPolGral
        AND cursoserpol.ClaveCur = cursos.ClaveCur";
        $parametros = [":id"=>$id];
        $resultados = $this->base->mostrar($querry, $parametros);
        return $resultados;
    }

    function certificaciones($id){
        $querry = "SELECT certinterna.NomCertInt
        FROM polgeneral, cerserpol, certinterna
        WHERE  polgeneral.IdPolGral = :id
        AND polgeneral.IdPolGral = cerserpol.IdPolGral
        AND cerserpol.IdCerInt = certinterna.IdCerInt";
        $parametros = [":id"=>$id];
        $resultados = $this->base->mostrar($querry, $parametros);
        return $resultados;
    }

    function tipo($id){
        $querry = "SELECT serviciospol.SerPol
        FROM serviciospol, polgeneral, sergralpol
        WHERE  polgeneral.IdPolGral = :id
        AND polgeneral.IdPolGral = sergralpol.IdPolGral
        AND sergralpol.IdSerPol = serviciospol.IdSerPol";
        $parametros = [":id"=>$id];
        $resultados = $this->base->mostrar($querry, $parametros);
        return $resultados;
    }
}

?>