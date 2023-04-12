<?php
include('../../config/Crud_bd.php'); 

class MostrarTemas{
    private $bd;

    function BD(){
        $this->bd = new Crud_bd();
        $this->bd->conexion_bd();
    }


    //hace la consulta principal de los datos de las certificaciones
    function cursos_disponibles(){
        $consulta = "SELECT ClaveCur, NomCur, DuracionCur FROM cursos";
        $datos = $this->bd->mostrar($consulta);

        return $datos;
    }
    function tema($id){
        /* $consulta = "SELECT  temas.NomTema, temas.IdTema  ORDER BY temas.IdTema ASC FROM cursos,cursotema,temas 
        where cursos.ClaveCur = '$id' and cursos.ClaveCur = cursotema.ClaveCur 
        and cursotema.IdTema = temas.IdTema"; */
        $consulta = "SELECT temas.NomTema, temas.IdTema FROM cursos, cursotema, temas 
        WHERE cursos.ClaveCur = '$id' 
        AND cursos.ClaveCur = cursotema.ClaveCur 
        AND cursotema.IdTema = temas.IdTema 
        ORDER BY temas.IdTema ASC;";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    }
    function subtema($id,$tes){

        $consulta = "SELECT subtemas.NomSubT,subtemas.IdSubT FROM temas, temassub, subtemas 
            where  temas.IdTema = '$tes'
            and temas.IdTema = temassub.IdTema
            and temassub.IdSubT = subtemas.IdSubT";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    }
}

$objeto = new MostrarCurso();
$objeto->BD();

?>