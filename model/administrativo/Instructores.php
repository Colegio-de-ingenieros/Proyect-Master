<?php

require_once('../../config/Crud_bd.php');

class Instructor_model extends Crud_bd{



    public function buscarCertificaciones()
    {
        $this->conexion_bd();
        $sql = "SELECT IdCerInt,NomCertInt FROM  certinterna " ;
        $datos =  $this->mostrar($sql);
        $this->cerrar_conexion();

        if(count($datos) > 0){
            return true;
        }else{
            return false;
        }
    }   

    public function obtener_numero_consecutivo()
    {
        # obtiene el ultimo numero consecutivo en el que van 
        $this->conexion_bd();
        $sql = "SELECT  MAX(CAST(SUBSTRING(ClaveIns,2) AS INT))  FROM  instructor";
        $numero = $this->mostrar($sql);
        $this->cerrar_conexion();

        return $numero;
    }

    public function agregar_ceros($numero,$largo)
    {
        $ceros = "";
        $numero_nuevo="";
        for ($i=0; $i < $largo ; $i++) { 
            $numero_nuevo = $ceros .$numero;
            if(strlen($numero_nuevo) == $largo){
                break;
            }else{
                $ceros = $ceros . "0";
            }

        }
        
        return $numero_nuevo;
    }

    public function insertarinstructor($nombre,$paterno,$materno)
    {
        #fabrica el numero para el instructor 
        $numero_consecutivo = $this->obtener_numero_consecutivo();
        $numero = "";

        if (is_null($numero_consecutivo[0][0]) == 1) {
            # significa que no hay registros por eso hay que generarlo
            $numero = 1;
        }else{
            $numero = $numero_consecutivo[0][0];
            $numero++;
           
        }
        $numero_con_ceros = $this->agregar_ceros($numero,5);
       
        $id_instructor = "I".$numero_con_ceros;

        # inserta el registro
        $this->conexion_bd();
        $sql = "INSERT INTO instructor (ClaveIns,NomIns,ApePIns,ApeMIns,EstatusIns) VALUES (:id,:nombre,:paterno,:materno,1)";
        $parametros = [":id"=>$id_instructor,":nombre"=>$nombre,":paterno"=>$paterno,":materno"=>$materno];
        $resultado = $this->insertar_eliminar_actualizar($sql,$parametros);
        $this->cerrar_conexion();
        
    }


}






?>