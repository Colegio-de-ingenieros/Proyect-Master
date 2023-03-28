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

}

$objeto = new VerCurso();
$objeto->BD();

?>