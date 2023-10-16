<?php
require_once ('../../config/Crud_bd.php'); 

class EliminarCurso extends Crud_bd{

    public function agregar_ceros($numero, $lon){
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

    public function buscaestatus($id=null){
        $this->conexion_bd();

        $querry1 = "SELECT EstatusCur FROM cursos WHERE ClaveCur=:id";
        $arre1 = [":id"=>$id];
        $resultados = $this->mostrar($querry1, $arre1);

        $this->cerrar_conexion();

        $this -> conexion_bd();
        $consulta = "SELECT cursoserpol.ClaveCur
        FROM cursoserpol, cursos
        WHERE cursos.ClaveCur = :id
        AND cursos.ClaveCur = cursoserpol.ClaveCur";

        $parametros = [":id"=>$id];
        $response = $this -> mostrar($consulta, $parametros);
        
        $this -> cerrar_conexion();

        if(count($response) > 0){
            return 2;
        }
        else if ($resultados[0]["EstatusCur"] == 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function eliminarcurso($id=null){
        $this->conexion_bd();

        $q2 = "DELETE FROM cursos WHERE ClaveCur = :id"; 
        $a2= [":id"=>$id];

        $this->insertar_eliminar_actualizar($q2, $a2);
        $this->cerrar_conexion();
    }

    public function eliminartema($id=null){
        $this->conexion_bd();
        $q2 = "DELETE FROM temas WHERE IdTema = :id"; 
        $a2= [":id"=>$id];
        $this->insertar_eliminar_actualizar($q2, $a2);
        $this->cerrar_conexion();
    }

    public function eliminartemasub($id=null){
        $this->conexion_bd();
        $q2 = "DELETE FROM temassub WHERE IdTema = :id"; 
        $a2= [":id"=>$id];
        $this->insertar_eliminar_actualizar($q2, $a2);
        $this->cerrar_conexion();
    }

    public function eliminarsubtema($id=null){
        $this->conexion_bd();
        $q2 = "DELETE FROM subtemas WHERE IdSubT = :id"; 
        $a2= [":id"=>$id];
        $this->insertar_eliminar_actualizar($q2, $a2);
        $this->cerrar_conexion();
    }

    public function eliminarcursotema($id=null){
        $this->conexion_bd();
        $q2 = "DELETE FROM cursotema WHERE ClaveCur = :id"; 
        $a2= [":id"=>$id];
        $this->insertar_eliminar_actualizar($q2, $a2);
        $this->cerrar_conexion();
    }

    public function t($id=null){
        $this->conexion_bd();
        $consulta = "SELECT temas.NomTema, temas.IdTema FROM cursos, cursotema, temas 
        WHERE cursos.ClaveCur = :id 
        AND cursos.ClaveCur = cursotema.ClaveCur 
        AND cursotema.IdTema = temas.IdTema 
        ORDER BY temas.IdTema ASC;";
        $datos = $this->mostrar($consulta,[":id"=>$id]);
        $this->cerrar_conexion();
        return $datos;
    }
    
    public function s($id=null){
        $this->conexion_bd();
        $consulta = "SELECT subtemas.NomSubT,subtemas.IdSubT FROM temas, temassub, subtemas 
            WHERE  temas.IdTema = :id
            AND temas.IdTema = temassub.IdTema
            AND temassub.IdSubT = subtemas.IdSubT;";
        $datos = $this->mostrar($consulta,[":id"=>$id]);
        $this->cerrar_conexion();
        return $datos;
    }
}



?>