<?php
include('../../config/Crud_bd.php'); 

class VerCurso{
    private $bd;

    function BD(){
        $this->bd = new Crud_bd();
        $this->bd->conexion_bd();
    }


    //hace la consulta principal de los datos de las certificaciones
    function cursos_disponibles($id){
        $consulta = "SELECT ClaveCur, NomCur, DuracionCur, ObjCur, EstatusCur FROM cursos where ClaveCur = $id";
        $datos = $this->bd->mostrar($consulta);

        return $datos;
    }

    function temas($id){
        $consulta = "SELECT DISTINCT NomTema FROM cursos,cursotema,temas 
        where cursos.ClaveCur = $id and cursos.ClaveCur = cursotema.ClaveCur 
        and cursotema.IdTema = temas.IdTema";
        $datos = $this->bd->mostrar($consulta);

        return $datos;
    }

    function tema($id){
        $consulta = "SELECT DISTINCT NomTema, NomSubT  FROM cursos,cursotema,temas,temassub,subtemas 
        where cursos.ClaveCur = $id and cursos.ClaveCur = cursotema.ClaveCur and cursotema.IdTema = temas.IdTema
        and temas.IdTema = temassub.IdTema and temassub.IdSubT = subtemas.IdSubT";
        $datos = $this->bd->mostrar($consulta);

        return $datos;
    }
    function subtemas($id){
        $consulta = "SELECT DISTINCT NomSubT  FROM cursos,cursotema,temas,temassub,subtemas 
        where cursos.ClaveCur = $id and cursos.ClaveCur = cursotema.ClaveCur and cursotema.IdTema = temas.IdTema
        and temas.IdTema = temassub.IdTema and temassub.IdSubT = subtemas.IdSubT";
        $datos = $this->bd->mostrar($consulta);

        return $datos;
    } 
    function cadasubtema($id){
        $consulta = "SELECT NomSubT FROM temas, temassub, subtemas WHERE temas.IdTema = $id
         and temas.IdTema = temassub.IdTema
        and temassub.IdSubT = subtemas.IdSubT";
        $datos = $this->bd->mostrar($consulta);
    }
    function t($id){
        /* $consulta = "SELECT  temas.NomTema, temas.IdTema  ORDER BY temas.IdTema ASC FROM cursos,cursotema,temas 
        where cursos.ClaveCur = '$id' and cursos.ClaveCur = cursotema.ClaveCur 
        and cursotema.IdTema = temas.IdTema"; */
        $consulta = "SELECT temas.NomTema, temas.IdTema FROM cursos, cursotema, temas 
        WHERE cursos.ClaveCur = '$id' 
        AND cursos.ClaveCur = cursotema.ClaveCur 
        AND cursotema.IdTema = temas.IdTema 
        ORDER BY temas.orden ASC;";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    }
    function s($id){

        $consulta = "SELECT subtemas.NomSubT,subtemas.IdSubT FROM temas, temassub, subtemas 
            where  temas.IdTema = '$id'
            and temas.IdTema = temassub.IdTema
            and temassub.IdSubT = subtemas.IdSubT
            ORDER BY subtemas.ordem ASC";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    }
}
/* tema
SELECT DISTINCT NomTema FROM cursos,cursotema,temas 
        where cursos.ClaveCur = '000000' and cursos.ClaveCur = cursotema.ClaveCur 
        and cursotema.IdTema = temas.IdTema
        
subtema  
SELECT NomSubT FROM temas, temassub, subtemas WHERE temas.IdTema = $id
         and temas.IdTema = temassub.IdTema
        and temassub.IdSubT = subtemas.IdSubT      */




$objeto = new VerCurso();
$objeto->BD();

?>