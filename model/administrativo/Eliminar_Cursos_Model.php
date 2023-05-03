<?php
require_once ('../../config/Crud_bd.php'); 

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

/*     function buscaestatus($id){
        $consulta = "SELECT EstatusCur FROM cursos
        WHERE cursos.ClaveCur = '$id';";
        $datos = $this->bd->mostrar($consulta);
        return $datos;
    } */
    function buscaestatus($id){
        $querry1 = "SELECT EstatusCur FROM cursos WHERE ClaveCur=:id";
        $arre1 = [":id"=>$id];
        $resultados = $this->bd->mostrar($querry1, $arre1);
        
        //Tiene un seguimiento el proyecto
        if ($resultados[0]["EstatusCur"]==0){
            return 1;
        }
        else{
            return 0;
        }
    }

    function eliminarcurso($id){
        $q2 = "DELETE FROM cursos WHERE ClaveCur = :id"; 
        $a2= [":id"=>$id];
        

        $this->bd->insertar_eliminar_actualizar($q2, $a2);
    }
    function eliminartema($id){
        $q2 = "DELETE FROM temas WHERE IdTema = :id"; 
        $a2= [":id"=>$id];
        

        $this->bd->insertar_eliminar_actualizar($q2, $a2);
    }
    function eliminartemasub($id){
        $q2 = "DELETE FROM temassub WHERE IdTema = :id"; 
        $a2= [":id"=>$id];
      
        $this->bd->insertar_eliminar_actualizar($q2, $a2);
    }
    function eliminarsubtema($id){
        $q2 = "DELETE FROM subtemas WHERE IdSubT = :id"; 
        $a2= [":id"=>$id];
       

        $this->bd->insertar_eliminar_actualizar($q2, $a2);
    }
    function eliminarcursotema($id){
        $q2 = "DELETE FROM cursotema WHERE ClaveCur = :id"; 
        $a2= [":id"=>$id];
       

        $this->bd->insertar_eliminar_actualizar($q2, $a2);
    }
    function t($id){
        $consulta = "SELECT temas.NomTema, temas.IdTema FROM cursos, cursotema, temas 
        WHERE cursos.ClaveCur = :id 
        AND cursos.ClaveCur = cursotema.ClaveCur 
        AND cursotema.IdTema = temas.IdTema 
        ORDER BY temas.IdTema ASC;";
        $datos = $this->bd->mostrar($consulta,[":id"=>$id]);
        return $datos;
    }
    function s($id){
        $consulta = "SELECT subtemas.NomSubT,subtemas.IdSubT FROM temas, temassub, subtemas 
            WHERE  temas.IdTema = :id
            AND temas.IdTema = temassub.IdTema
            AND temassub.IdSubT = subtemas.IdSubT;";
        $datos = $this->bd->mostrar($consulta,[":id"=>$id]);
        return $datos;
    }
}

/* $objeto = new EliminarCurso();
$objeto->BD(); */

?>