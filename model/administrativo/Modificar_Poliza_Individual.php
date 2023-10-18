<?php
require_once('../../config/Crud_bd.php');

class Modificar_Poliza_Individual extends Crud_bd{

    public function datos_generales($id_poliza) {
        $this->conexion_bd();
        $consulta = "SELECT CONCAT(NomElaPol,' ',COALESCE(ApePElaPol,''), COALESCE(ApeMElaPol,'')), CoceptoGral, DATE_FORMAT(FechaPolGral,'%d/%m/%Y') as FechaPolGral  FROM polgeneral WHERE polgeneral.IdPolGral = :id";
        $resultados = $this->mostrar($consulta,[":id"=>$id_poliza]);
        $this->cerrar_conexion();

  

        return $resultados;
    }

    public function polizas_individuales($id_poliza){
        $this->conexion_bd();
        $consulta = "SELECT indpolacc.IdPolAcc ,polindividual.IdPolInd, DesPolInd, Monto, DesDocInd  from polindividual 
                    INNER JOIN indgralpol on indgralpol.IdPolInd = polindividual.IdPolInd AND indgralpol.IdPolGral = :id
                    INNER JOIN indpolacc on polindividual.IdPolInd = indpolacc.IdPolInd";
                    
        $resultados = $this->mostrar($consulta,[":id"=>$id_poliza]);
        $this->cerrar_conexion();

        $resultado_procesado = [];

        for($i=0; $i<count($resultados);$i++){
            $filas = $resultados[$i];
            $fila = array();
            for ($j=0; $j < 5 ; $j++) { 
                
                array_push($fila, $filas[$j]);

            }

            $resultado_procesado[$i] = $fila;
            
        }


        return $resultado_procesado;
    }

    public function propietario_poliza($id_poliza){

        # ver si es de una empresa 
        $datos = [];
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT CONCAT('Emp. ',usuaemp.NomUsuaEmp) FROM usuaemp
        INNER JOIN (SELECT RFCUsuaEmp FROM empgralpol WHERE IdPolGral =  :id) as tabla on tabla.RFCUsuaEmp = usuaemp.RFCUsuaEmp",[':id'=>$id_poliza]);

        if(count($datos) == 0){
            
            $datos = $this->mostrar("SELECT CONCAT(usuaperso.NomPerso,' ',COALESCE(usuaperso.ApePPerso, ' '),' ',COALESCE(usuaperso.ApeMPerso, ' ')) as nombrecompleto, tipousua.TipoU FROM usuaperso 
            INNER JOIN (SELECT IdPerso FROM persogralpol WHERE IdPolGral = :id) as tabla on tabla.IdPerso = usuaperso.IdPerso
            INNER JOIN  persotipousua on persotipousua.IdPerso = usuaperso.IdPerso
            INNER JOIN tipousua on tipousua.IdUsua = persotipousua.IdUsua",[':id'=>$id_poliza]);

            $tipo_usuario = $datos[0][1];

            if($tipo_usuario == "Asociado"){
                $tipo_usuario = "Asoc. " ;
            }else if($tipo_usuario == "Socio"){
                $tipo_usuario = "Soc. ";
            }
            $nombre = $tipo_usuario.$datos[0][0];

            $datos[0][0] = $nombre;
            
        }
        $this->cerrar_conexion();

        return $datos;

    }
    function tipo_servicio($id_poliza,$tipo){
        $regresar = [];
        if($tipo == "Certificación"){
            $this->conexion_bd();
            $sql = "SELECT NomCertInt FROM certinterna,cerserpol WHERE cerserpol.IdCerInt =certinterna.IdCerInt  AND cerserpol.IdPolGral=:id";
            $parametros = [":id"=>$id_poliza];
            $resultados = $this->mostrar($sql, $parametros);
            $this->cerrar_conexion();
            $regresar[] = $tipo." ". $resultados[0][0];

        }else if($tipo == "Curso"){

            $this->conexion_bd();
            $sql = "SELECT NomCur FROM cursoserpol,cursos WHERE IdPolGral=:id AND cursos.ClaveCur=cursoserpol.ClaveCur ";
            $parametros = [":id"=>$id_poliza];
            $resultados = $this->mostrar($sql, $parametros);
            $this->cerrar_conexion();
            $regresar[] = $tipo." ". $resultados[0][0];

        }else{
            $regresar[] = $tipo;
        }
        
        
        return $regresar;
        
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

    public function extraer_numero_polizas()
    {
        # obtiene el ultimo numero consecutivo en el que van  y le agrega 1
        $this->conexion_bd();
        $sql = "SELECT  MAX(CAST(SUBSTRING(IdPolInd,2) AS INT))  FROM  polindividual " ;
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

    function modificar_polizas($id_poliza,$resultado_procesado){
        
        $sqls = [];
        $parametros = [];
        $id_poliza_nueva = $this->extraer_numero_polizas();
        $poliza = [];
        
        for ($i=0; $i < count($resultado_procesado) ; $i++) { 

            $poliza = $resultado_procesado[$i];
        
            
            if($poliza[0] == "new"){

                $sqls[] = "INSERT INTO polindividual ( IdPolInd,DesPolInd,Monto,DesDocInd) VALUES (:id,:concepto, :monto,:descripcion)";
                $parametros[] = [":id"=>$id_poliza_nueva, ":concepto"=>$poliza[3], ":monto"=>$poliza[2], ":descripcion"=>$poliza[4]];

                $sqls[] = "INSERT INTO  indgralpol ( IdPolGral, IdPolInd) VALUES (:idGeneral,:idIndividual)";
                $parametros[] =  [":idGeneral"=>$id_poliza,":idIndividual"=>$id_poliza_nueva];

                $sqls[] = "INSERT INTO  indpolacc (IdPolInd, IdPolAcc) VALUES (:idInd,:idTipo)";
                $parametros[] = [":idInd"=>$id_poliza_nueva, ":idTipo"=>$poliza[1] ];

                $resultado_procesado[$i][1] = $id_poliza_nueva;

                $id_poliza_nueva++;

                $id_poliza_nueva = $this->agregar_ceros($id_poliza_nueva,6);


            }else if($poliza[0] == "update"){

                $sqls[] = "UPDATE polindividual SET DesPolInd = :concepto, Monto = :monto, DesDocInd = :descripcion WHERE IdPolInd = :idp";
                $parametros[] = [":idp"=>$poliza[1], ":concepto"=>$poliza[4], ":monto"=>$poliza[3], ":descripcion"=>$poliza[5]];

                $sqls[] = "DELETE FROM indpolacc WHERE IdPolInd = :idpa";
                $parametros[] = [":idpa"=>$poliza[1] ];

                $sqls[] = "INSERT INTO  indpolacc (IdPolInd, IdPolAcc) VALUES (:idInd,:idTipo)";
                $parametros[] = [":idInd"=>$poliza[1], ":idTipo"=>$poliza[2] ];

            }else{

                $sqls[] = "DELETE FROM indgralpol WHERE IdPolInd = :idInd";
                $parametros[] = [":idInd"=>$poliza[1]];

                $sqls[] = "DELETE FROM indpolacc WHERE IdPolInd = :idpa";
                $parametros[] = [":idpa"=>$poliza[1]];

                $sqls[] = "DELETE FROM polindividual WHERE IdPolInd = :idp";
                $parametros[] = [":idp"=>$poliza[1]];

            }
            
        }

        $this->conexion_bd();
        $resultado = $this->insertar_eliminar_actualizar($sqls,$parametros);
        $this->cerrar_conexion();

        if($resultado){
       
            return $resultado_procesado;
        }else{
            return array();
        }
        
    }


 







}






?>