<?php
include('../../config/Crud_bd.php'); 

class MostrarProyectos{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //hace la consulta principal de los datos de los proyectos
    function getProyectos(){
        $querry = "SELECT * FROM proyectos";
        $resultados = $this->base->mostrar($querry);

        return $resultados;
    }
    function getIniPro(){
        $querry1 = "SELECT DATE_FORMAT(IniPro, '%d/%m/%Y') IniPro  FROM proyectos";
        $resultados1 = $this->base->mostrar($querry1);

        return $resultados1;
    }
    function getFinPro(){
        $querry2 = "SELECT DATE_FORMAT(FinPro, '%d/%m/%Y') FinPro  FROM proyectos";
        $resultados2 = $this->base->mostrar($querry2);

        return $resultados2;
    }

    function getProyectosId($idp){
        $querry = "SELECT * FROM proyectos Where IdPro=:idp";
        $resultados = $this->base->mostrar($querry,[":idp"=>$idp]);

        return $resultados;
    }
    function getIniProId($idp){
        $querry1 = "SELECT IniPro  FROM proyectos Where IdPro=:idp";
        $resultados1 = $this->base->mostrar($querry1,[":idp"=>$idp]);

        return $resultados1;
    }
    function getFinProId($idp){
        $querry2 = "SELECT DATE_FORMAT(FinPro, '%d/%m/%Y') FinPro  FROM proyectos Where IdPro=:idp";
        $resultados2 = $this->base->mostrar($querry2,[":idp"=>$idp]);

        return $resultados2;
    }

    function consultaInteligente($valor){
        $querry = "SELECT * FROM proyectos
        WHERE NomProyecto LIKE :q OR IniPro LIKE :q OR FinPro LIKE :q OR MontoPro LIKE :q";

        $arre = [":q"=>'%'.$valor.'%'];

        $resultados = $this->base->mostrar($querry, $arre);

        return $resultados;
    }
}

?>