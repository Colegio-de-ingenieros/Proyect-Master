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

    public function extraerInstructores(){
        $this->conexion_bd();
        $consulta = "SELECT ClaveIns, NomIns, ApePIns, ApeMIns, EstatusIns FROM instructor";
        $resultados = $this->mostrar($consulta);
        $this->cerrar_conexion();

        return $resultados;
    }

    public function extraerInfoInstructorIndividual($id){
        /* Extraemos la información individual del instructor */
        $this->conexion_bd();
        $consulta = "SELECT ClaveIns, NomIns, ApePIns, ApeMIns, EstatusIns 
        FROM instructor 
        WHERE ClaveIns = :id";
        $parametros = [":id"=>$id];
        $resultados_datos_basicos = $this->mostrar($consulta,$parametros);

        /* Extraemos las certificaciones internas del instructor */
        $consulta = "SELECT certinterna.NomCertInt, certinterna.DesCerInt, certinterna.EstatusCertInt 
        from certinterna, inscertint
        WHERE inscertint.ClaveIns = :id
        and inscertint.IdCerInt = certinterna.IdCerInt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_internas = $this->mostrar($consulta,$parametros);

        /* Extraemos las certificaciones externas del instructor */
        $consulta = "SELECT certexterna.NomCerExt, certexterna.OrgCerExt, certexterna.IniCerExt, certexterna.FinCerExt
        from certexterna, inscertext
        WHERE inscertext.ClaveIns = :id
        and inscertext.IdCerExt = certexterna.IdCerExt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_externas = $this->mostrar($consulta,$parametros);

        /* Extraemos las especialidades del instructor */
        $consulta = "SELECT especialidades.NomEspIns 
        FROM especialidades, especialins 
        WHERE especialins.ClaveIns = :id 
        AND especialins.IdEspIns = especialidades.IdEspIns";
        $parametros = [":id"=>$id];
        $resultados_especialidades = $this->mostrar($consulta,$parametros);

    }
}   

?>