<?php
/*
* 
* Este archivo crea las consultas para una base de datos en phpmyadmin
*/
define("HOST", "mysql:host=localhost;");
define("DBNAME", "dbname=colegiociscig");
define("USUARIO", "AdminCISCIG");
define("PASSWORD", 'ColegioCISCIG2023.');


class CRUD_general{

    private $conexion;

    public function conexion_bd(){

        /**
         * Esta funcion crea la conexion con la base de datos
         */

        try {
            
            $this->conexion = new PDO(HOST. DBNAME,USUARIO,PASSWORD );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion->exec("SET CHARACTER SET UTF8");
            
            return $this->conexion;
        } catch (Exception $e) {

            die("Error:".$e->getMessage());
            echo "Linea del error " . $e->getLine();
        }

        
    }

    public function mostrar($consultaEscrita, ?array $arrayAsociativo = null){
        /**
         * Esta funcion regresa un array asociativo y un array normal con 
         * los elementos de la tabla
         */
        
        try{

            if($arrayAsociativo == null){
                $sentencia = $this->conexion->query($consultaEscrita);
            }else{
                $sentencia = $this->conexion->prepare($consultaEscrita);
                $sentencia->execute($arrayAsociativo);
        
            }
            
            $filas=$sentencia->fetchAll();
            $sentencia = null;
    
            #var_dump($filas);
            return $filas;

        } catch (Exception $e) {

            die("Error:".$e->getMessage());
            echo "Linea del error " . $e->getLine();
        }
    }

    public function insertar_eliminar_actualizar($consultaEscrita, $arrayAsociativo){
        /**
         * Esta funcion perminte insertar, eliminar, los parametros de busqueda y modificacion 
         * se colocan en el array asociativo 
         */
        try{
            $resultados=$this->conexion->prepare($consultaEscrita);
            $resultados->execute($arrayAsociativo);
            $resultados = null;
            
            return true;
        }catch (Exception $e) {

            die("Error:".$e->getMessage());
            echo "Linea del error " . $e->getLine();
        }
       

    }



    public function cerrar_conexion()
    {
        $this->conexion = null;
    }

    


}



?>