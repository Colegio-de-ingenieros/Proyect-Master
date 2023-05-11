<?php

require_once('../../config/Crud_bd.php');

class Instructor_model extends Crud_bd{



    public function buscarCertificacionExternas()
    {
        $this->conexion_bd();
        $sql = "SELECT IdCerInt,NomCertInt FROM  certinterna " ;
        $datos =  $this->mostrar($sql);
        $this->cerrar_conexion();

        return $datos;
    }   

    public function obtener_numero_consecutivo_instructores()
    {
        # obtiene el ultimo numero consecutivo en el que van 
        $this->conexion_bd();
        $sql = "SELECT  MAX(CAST(SUBSTRING(ClaveIns,2) AS INT))  FROM  instructor";
        $numero_consecutivo = $this->mostrar($sql);
        $this->cerrar_conexion();

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

        return $id_instructor;
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

    public function extraer_numero_certificaciones()
    {
        $this->conexion_bd();
        $sql = "SELECT  MAX(CAST(SUBSTRING(IdCerExt,2) AS INT))  FROM  certexterna " ;
        $numero_consecutivo =  $this->mostrar($sql);
        $this->cerrar_conexion();
        $numero = "";

        if (is_null($numero_consecutivo[0][0]) == 1) {
            # significa que no hay registros por eso hay que generarlo
            $numero = 1;
        }else{
            $numero = $numero_consecutivo[0][0];
            $numero++;
           
        }
        $numero_con_ceros = $this->agregar_ceros($numero,6);
       

        return $numero_con_ceros;

    }

    public function extraer_numero_especialidades()
    {
        $this->conexion_bd();
        $sql = "SELECT  MAX(CAST(SUBSTRING(IdEspIns,2) AS INT))  FROM  especialidades " ;
        $numero_consecutivo =  $this->mostrar($sql);
        $this->cerrar_conexion();
        $numero = "";

        if (is_null($numero_consecutivo[0][0]) == 1) {
            # significa que no hay registros por eso hay que generarlo
            $numero = 1;
        }else{
            $numero = $numero_consecutivo[0][0];
            $numero++;
           
        }
        $numero_con_ceros = $this->agregar_ceros($numero,6);
       

        return $numero_con_ceros;

    }

    public function insertarinstructor($nombre,$paterno,$materno,$certificaciones,$especialidades,$certificaciones_int)
    {
        $sqls = [];
        $parametros = [];
     
        #fabrica el numero para el instructor 
        $id_instructor = $this->obtener_numero_consecutivo_instructores();
        # inserta el registro
        
        $sqls[] = "INSERT INTO instructor (ClaveIns,NomIns,ApePIns,ApeMIns,EstatusIns) VALUES (:id,:nombre,:paterno,:materno,1)";
        $parametros[] = [":id"=>$id_instructor,":nombre"=>$nombre,":paterno"=>$paterno,":materno"=>$materno];

        # agregemos las consultas de las certificaciones externas
        $id_externa = $this->extraer_numero_certificaciones();

        for ($i=0; $i < count($certificaciones) ; $i++) { 
           
            //echo $i." certificaciones externas". $id_externa."<br>";
            $sqls[] =  "INSERT INTO certexterna (IdCerExt,NomCerExt,OrgCerExt,IniCerExt,FinCerExt)
                         VALUES (:idCer,:nomCer, :orgCer, :iniCer,:finCer)";
            $parametros[] = [":idCer" =>$id_externa , ":nomCer" => $certificaciones[$i][0], 
                            ":orgCer"=>$certificaciones[$i][1], ":iniCer"=>$certificaciones[$i][2],
                            ":finCer"=>$certificaciones[$i][3]
                            ];

            $sqls[] = "INSERT INTO inscertext (ClaveIns,IdCerExt) VALUES (:idI,:idCe)";
            $parametros[] = [":idI"=>$id_instructor,":idCe"=>$id_externa];

            $numero = $id_externa+1;
            $id_externa = $this->agregar_ceros($numero,6);
            
            
        }
        # agregemos las consultas de las especialidades 
        $id_especialidad = $this->extraer_numero_especialidades();

        for ($i=0; $i < count($especialidades) ; $i++) { 

            //echo $i."especialidad ". $id_especialidad ."<br>";

            $sqls[] =  "INSERT INTO especialidades (IdEspIns,NomEspIns) VALUES(:idEspe,:nombre)";
            $parametros[] = [":idEspe" =>$id_especialidad , ":nombre" => $especialidades[$i]];

            $sqls[] = "INSERT INTO especialins (ClaveIns,IdEspIns) VALUES (:idI,:idCe)";
            $parametros[] = [":idI"=>$id_instructor,":idCe"=>$id_especialidad];

            $numero = $id_especialidad+1;
            $id_especialidad = $this->agregar_ceros($numero,6);
        }

        #agregamos la relacion de las certificaciones internas con el instructor
        for ($index=0; $index < count($certificaciones_int) ; $index++) { 
            //echo $index."Certificacion interna";
            $sqls[] = "INSERT INTO inscertint (ClaveIns,IdCerInt) VALUES(:id,:idcerin)";
            $parametros[] = [":id"=>$id_instructor,":idcerin"=>$certificaciones_int[$index]];
        }
        $this->conexion_bd();
        $resultado = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        return $resultado;

        
    }

    public function extraerInstructores(){
        $this->conexion_bd();
        $consulta = "SELECT ClaveIns, NomIns, ApePIns, ApeMIns, EstatusIns FROM instructor";
        $resultados = $this->mostrar($consulta);
        $this->cerrar_conexion();

        return $resultados;
    }

    public function mostrar_instructor_individual($id){
        //* Extraemos la información individual del instructor 
        $this->conexion_bd();
        $consulta = "SELECT NomIns, ApePIns, ApeMIns 
        FROM instructor 
        WHERE ClaveIns = :id";
        $parametros = [":id"=>$id];
        $resultados_datos_basicos = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones internas del instructor 
        $consulta = "SELECT certinterna.NomCertInt, certinterna.DesCerInt, certinterna.EstatusCertInt 
        from certinterna, inscertint
        WHERE inscertint.ClaveIns = :id
        and inscertint.IdCerInt = certinterna.IdCerInt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_internas = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones externas del instructor
        $consulta = "SELECT certexterna.NomCerExt, certexterna.OrgCerExt, certexterna.IniCerExt, certexterna.FinCerExt
        from certexterna, inscertext
        WHERE inscertext.ClaveIns = :id
        and inscertext.IdCerExt = certexterna.IdCerExt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_externas = $this->mostrar($consulta,$parametros);

        //* Extraemos las especialidades del instructor
        $consulta = "SELECT especialidades.NomEspIns 
        FROM especialidades, especialins 
        WHERE especialins.ClaveIns = :id 
        AND especialins.IdEspIns = especialidades.IdEspIns";
        $parametros = [":id"=>$id];
        $resultados_especialidades = $this->mostrar($consulta,$parametros);

        //* Juntamos todas las variables en un solo arreglo
        $resultados = [
            "datos_basicos"=>$resultados_datos_basicos,
            "especialidades"=>$resultados_especialidades,
            "certificaciones_internas"=>$resultados_certificaciones_internas,
            "certificaciones_externas"=>$resultados_certificaciones_externas
        ];

        $this->cerrar_conexion();
        //* Retorna el arreglo con toda la información
        return $resultados;
    }

    public function eliminar_instructor($id){
        $this->conexion_bd();

        //* Seleccionamos el estatus del instructor para saber si está con seguimiento o no
        $consulta = "SELECT EstatusIns FROM instructor WHERE ClaveIns = :id";
        $parametros = [":id"=>$id];
        $resultados_estatus = $this->mostrar($consulta,$parametros);

        $lista_estatus = array_column($resultados_estatus,'EstatusIns');
        //* Si el estatus es 1, significa que el instructor está sin seguimiento
        if($lista_estatus == 0){
            return false;
        }
        else{
            //* Eliminamos todos los ids de las certificaciones internas del instructor
            $consulta = "DELETE FROM inscertint WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $this->insertar_eliminar_actualizar($consulta,$parametros);

            //* Seleccionamos todos los ids de las especialidades del instructor
            $consulta = "SELECT IdEspIns FROM especialins WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $resultados_id_especialidades = $this->mostrar($consulta,$parametros);

            //* Eliminamos todas las especialidades del instructor
            if(count($resultados_id_especialidades) > 0){

                //* Eliminamos la relación de las especialidades con el instructor
                $consulta = "DELETE FROM especialins WHERE ClaveIns = :id";
                $parametros = [":id"=>$id];
                $this->insertar_eliminar_actualizar($consulta,$parametros);

                $lista_id_especialidades = array_column($resultados_id_especialidades,'IdEspIns');

                for($i = 0; $i < count($lista_id_especialidades); $i++){
                    $consulta = "DELETE FROM especialidades WHERE IdEspIns = :id";
                    $parametros = [":id"=>$lista_id_especialidades[$i]];
                    $this->insertar_eliminar_actualizar($consulta,$parametros);
                }
            }

            //* Seleccionamos todos los ids de las certificaciones externas del instructor
            $consulta = "SELECT IdCerExt FROM inscertext WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $resultados_id_certificaciones_externas = $this->mostrar($consulta,$parametros);
            
            if(count($resultados_id_certificaciones_externas) > 0){
                //* Eliminamos la relación de las certificaciones externas con el instructor
                $consulta = "DELETE FROM inscertext WHERE ClaveIns = :id";
                $parametros = [":id"=>$id];
                $this->insertar_eliminar_actualizar($consulta,$parametros);

                $lista_id_certificaciones_externas = array_column($resultados_id_certificaciones_externas,'IdCerExt');

                //* Eliminamos todas las certificaciones externas del instructor
                for($i = 0; $i < count($lista_id_certificaciones_externas); $i++){
                    $consulta = "DELETE FROM certexterna WHERE IdCerExt = :id";
                    $parametros = [":id"=>$lista_id_certificaciones_externas[$i]];
                    $this->insertar_eliminar_actualizar($consulta,$parametros);
                }
            }

            //* Seleccionamos todos los elementos de la tabla seguimiento
            $consulta = "SELECT seguimiento.IdSeg 
            FROM seguimiento, insparticipa, instructor 
            WHERE instructor.ClaveIns = :id 
            AND instructor.ClaveIns = insparticipa.ClaveIns 
            AND insparticipa.IdSeg = seguimiento.IdSeg;";
            $parametros = [":id"=>$id];
            $resultados_id_seguimiento = $this->mostrar($consulta,$parametros);

            if(count($resultados_id_seguimiento) > 0){
                $lista_id_seguimiento = array_column($resultados_id_seguimiento,'IdSeg');

                //* Eliminamos la relación de los instructores con el seguimiento
                $consulta = "DELETE FROM insparticipa WHERE ClaveIns = :id";
                $parametros = [":id"=>$id];
                $this->insertar_eliminar_actualizar($consulta,$parametros);

                //* Eliminamos todos los instructores que estén en la tabla seguimiento
                for($i = 0; $i < count($lista_id_seguimiento); $i++){
                    $consulta = "DELETE FROM seguimiento WHERE IdSeg = :id";
                    $parametros = [":id"=>$lista_id_seguimiento[$i]];
                    $this->insertar_eliminar_actualizar($consulta,$parametros);
                }
            }

            //* Eliminamos el instructor
            $consulta = "DELETE FROM instructor WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $this->insertar_eliminar_actualizar($consulta,$parametros);
            return true;
        }
        $this->cerrar_conexion();
    }
}   
/*
$m = new Instructor_model();
$r = $m->insertarinstructor("juan","jose","",[["12","no hay","2023-04-12","2023-04-24"],["13","no hay","2023-04-12","2023-04-24"],["14","no hay","2023-04-12","2023-04-24"]],["uno1","dos1","tres1","cuatro1"],["000001","000002"]);
echo $r;*/
?>