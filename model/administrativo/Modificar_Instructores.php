<?php
require_once('../../config/Crud_bd.php');

class Modificar_Instructor extends Crud_bd{

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
        # obtiene el ultimo numero consecutivo en el que van  y le agrega 1
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

    public function modificarinstructor($id_instructor,$nombre,$apellido_p,$apellido_m,$certificacionesExternas,$especialidades,$certificacionesInternas)
    {
        // eliminar

        $sqls = [];
        $parametros = [];

        $sqls[] = "UPDATE instructor SET NomIns=:nombre, ApePIns=:paterno, ApeMIns=:materno   WHERE ClaveIns=:id ";
        $parametros[] = [":id"=>$id_instructor,":nombre"=>$nombre,":paterno"=>$apellido_p,":materno"=>$apellido_m];

        $sqls[] = "DELETE FROM inscertint WHERE ClaveIns=:id";
        $parametros[] = [":id"=>$id_instructor];

        #certificacion externa
      
        for ($i=0; $i < count($certificacionesExternas) ; $i++) { 

            if($certificacionesExternas[$i][0] == "new"){

                $sqls[] =  "INSERT INTO certexterna (IdCerExt,NomCerExt,OrgCerExt,IniCerExt,FinCerExt)
                         VALUES (
                            (SELECT id FROM (SELECT LPAD(COALESCE(MAX(CAST(SUBSTRING(IdCerExt,2) AS INT))+1,1),6,'0') as id  FROM  certexterna) AS tabla),
                            :nomCer, :orgCer, :iniCer,:finCer)";
                $parametros[] = [ ":nomCer" => $certificacionesExternas[$i][1], 
                                ":orgCer"=>$certificacionesExternas[$i][2], ":iniCer"=>$certificacionesExternas[$i][3],
                                ":finCer"=>$certificacionesExternas[$i][4]
                                ];

                $sqls[] = "INSERT INTO inscertext (ClaveIns,IdCerExt) VALUES (:idI,
                (SELECT id FROM (SELECT LPAD(COALESCE(MAX(CAST(SUBSTRING(IdCerExt,2) AS INT)),1),6,'0') as id  FROM  certexterna) AS tabla))";
                $parametros[] = [":idI"=>$id_instructor];

             

            }else if($certificacionesExternas[$i][0] == "update"){

                $sqls[] =  "UPDATE certexterna SET NomCerExt=:nomCer, OrgCerExt=:orgCer, IniCerExt=:iniCer, FinCerExt=:finCer WHERE  IdCerExt=:idCer";
                $parametros[] = [":idCer" =>$certificacionesExternas[$i][1] , ":nomCer" => $certificacionesExternas[$i][2], 
                                ":orgCer"=>$certificacionesExternas[$i][3], ":iniCer"=>$certificacionesExternas[$i][4],
                                ":finCer"=>$certificacionesExternas[$i][5]
                                ];
            
            }else{
              

                $sqls[] = "DELETE FROM inscertext WHERE ClaveIns=:idInstructor AND IdCerExt=:idExterna";
                $parametros[] = [":idInstructor"=> $id_instructor,":idExterna"=>$certificacionesExternas[$i][1]];

                $sqls[] = "DELETE FROM certexterna WHERE IdCerExt = :id";
                $parametros[] = [":id"=>$certificacionesExternas[$i][1]];
                
            }  
            
        }

        # agregemos las consultas de las especialidades 

        for ($i=0; $i < count($especialidades) ; $i++) { 
           

            if($especialidades[$i][0] == "new"){

                $sqls[] =  "INSERT INTO especialidades (IdEspIns,NomEspIns) VALUES(
                    (SELECT id FROM (SELECT LPAD(COALESCE(MAX(CAST(SUBSTRING(IdEspIns,2) AS INT))+1,1),6,'0') as id  FROM  especialidades) AS tabla),
                    :nombre)";
                $parametros[] = [":nombre" => $especialidades[$i][1]];

                $sqls[] = "INSERT INTO especialins (ClaveIns,IdEspIns) VALUES (:idI,
                (SELECT id FROM (SELECT LPAD(COALESCE(MAX(CAST(SUBSTRING(IdEspIns,2) AS INT)),1),6,'0') as id  FROM  especialidades) AS tabla))";
                $parametros[] = [":idI"=>$id_instructor];

            }else if($especialidades[$i][0] == "update"){
            
                $sqls[] =  "UPDATE especialidades SET NomEspIns=:nombre WHERE IdEspIns=:idEspe";
                $parametros[] = [":idEspe" =>$especialidades[$i][1],":nombre" => $especialidades[$i][2]];
            
            }else{

                $id_especialidad_temp = $especialidades[$i][1];
                $sqls[] = "DELETE FROM especialins WHERE ClaveIns=:i AND IdEspIns=:c; DELETE FROM especialidades WHERE IdEspIns=:c";
                $parametros[] = [":i"=>$id_instructor,":c"=>$id_especialidad_temp];
               
            }
            
        }

        #agregamos la relacion de las certificaciones internas con el instructor
        for ($index=0; $index < count($certificacionesInternas) ; $index++) { 
            //echo $index."Certificacion interna";
            $sqls[] = "INSERT INTO inscertint (ClaveIns,IdCerInt) VALUES(:id,:idcerin)";
            $parametros[] = [":id"=>$id_instructor,":idcerin"=>$certificacionesInternas[$index]];
        }


        $this->conexion_bd();
        $resultado = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        return $resultado;

    }
    public function mostrarInstructorParaModificacion($id)
    {
        # me da el codigo del instructor y traego sus datos
        //* Extraemos la información individual del instructor 
        $this->conexion_bd();
        $consulta = "SELECT NomIns, ApePIns, ApeMIns 
        FROM instructor 
        WHERE ClaveIns = :id";
        $parametros = [":id"=>$id];
        $resultados_datos_basicos = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones internas del instructor 
        $consulta = "SELECT certinterna.IdCerInt
        from certinterna, inscertint
        WHERE inscertint.ClaveIns = :id
        and inscertint.IdCerInt = certinterna.IdCerInt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_internas = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones externas del instructor
        $consulta = "SELECT certexterna.IdCerExt, certexterna.NomCerExt, certexterna.OrgCerExt, certexterna.IniCerExt, certexterna.FinCerExt
        from certexterna, inscertext
        WHERE inscertext.ClaveIns = :id
        and inscertext.IdCerExt = certexterna.IdCerExt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_externas = $this->mostrar($consulta,$parametros);

        //* Extraemos las especialidades del instructor
        $consulta = "SELECT especialidades.IdEspIns, especialidades.NomEspIns 
        FROM especialidades, especialins 
        WHERE especialins.ClaveIns = :id 
        AND especialins.IdEspIns = especialidades.IdEspIns";
        $parametros = [":id"=>$id];
        $resultados_especialidades = $this->mostrar($consulta,$parametros);

        //* Juntamos todas las variables en un solo arreglo
        $resultados = [ $resultados_datos_basicos,
                        $resultados_especialidades,
                        $resultados_certificaciones_internas,
                        $resultados_certificaciones_externas
                    ];

        $this->cerrar_conexion();
        //* Retorna el arreglo con toda la información
        return $resultados;

    }
}



?>