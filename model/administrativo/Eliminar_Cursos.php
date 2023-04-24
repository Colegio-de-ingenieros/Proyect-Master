<?php
include('../../config/Crud_bd.php'); 

class EliminarCurso{
    private $bd;

    function BD(){
        $this->bd = new Crud_bd();
        $this->bd->conexion_bd();
    }
    function agregar_ceros($numero, $lon){
        $ceros = "";
        $numero_nuevo="";
        for ($i=0; $i < $lon ; $i++) { 
            $numero_nuevo = $ceros . $numero;
            if(strlen($numero_nuevo) == $lon){
                break;
            }else{
                $ceros = $ceros . "0";
            }
        }
        return $numero_nuevo;
    }

    function buscaestatus($id){
        $consulta = "SELECT EstatusCur FROM cursos
        WHERE cursos.ClaveCur = '$id';";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    }

    function eliminarcurso($id){
        $q2 = "DELETE FROM cursos WHERE ClaveCur = :id"; 
        $a2= [":id"=>$id];
        $querry = [$q2];
        $parametros = [$a2];

        $this->bd->insertar_eliminar_actualizar($querry, $parametros);
    }
    function eliminartema($id){
        $q2 = "DELETE FROM temas WHERE IdTema = :id"; 
        $a2= [":id"=>$id];
        $querry = [$q2];
        $parametros = [$a2];

        $this->bd->insertar_eliminar_actualizar($querry, $parametros);
    }
    function eliminartemasub($id){
        $q2 = "DELETE FROM temassub WHERE IdTema = :id"; 
        $a2= [":id"=>$id];
        $querry = [$q2];
        $parametros = [$a2];

        $this->bd->insertar_eliminar_actualizar($querry, $parametros);
    }
    function eliminarsubtema($id){
        $q2 = "DELETE FROM subtemas WHERE IdSubT = :id"; 
        $a2= [":id"=>$id];
        $querry = [$q2];
        $parametros = [$a2];

        $this->bd->insertar_eliminar_actualizar($querry, $parametros);
    }
    function eliminarcursotema($id){
        $q2 = "DELETE FROM cursotema WHERE ClaveCur = :id"; 
        $a2= [":id"=>$id];
        $querry = [$q2];
        $parametros = [$a2];

        $this->bd->insertar_eliminar_actualizar($querry, $parametros);
    }
    function t($id){
        $consulta = "SELECT temas.NomTema, temas.IdTema FROM cursos, cursotema, temas 
        WHERE cursos.ClaveCur = '$id' 
        AND cursos.ClaveCur = cursotema.ClaveCur 
        AND cursotema.IdTema = temas.IdTema 
        ORDER BY temas.IdTema ASC;";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    }
    function s($id,$tes){
        $consulta = "SELECT subtemas.NomSubT,subtemas.IdSubT FROM temas, temassub, subtemas 
            where  temas.IdTema = '$tes'
            and temas.IdTema = temassub.IdTema
            and temassub.IdSubT = subtemas.IdSubT";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    }
}

$objeto = new EliminarCurso();
$objeto->BD();

?>