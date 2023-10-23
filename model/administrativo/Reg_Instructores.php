<?php
require_once('../../config/Crud_bd.php');

class Registro_Instructor extends Crud_bd{

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
        # obtiene el ultimo numero consecutivo en el que van  y le agrega 1
        $this->conexion_bd();
        $sql = "SELECT  MAX(CAST(IdCerExt AS INT))  FROM  certexterna " ;
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
        # obtiene el ultimo numero consecutivo en el que van  y le agrega 1
        $this->conexion_bd();
        $sql = "SELECT  MAX(CAST(IdEspIns AS INT))  FROM  especialidades " ;
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


}




?>