<?php
include('../../config/Crud_bd.php');

class Nuevapoliza{
    private $base;

    //crea un objeto del CRUD para hacer las consultas
    function conexion(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //manda las consultas para insertar en las tablas de certificaciones internas e historicos
    function insertar($nombre, $apat, $amat, $rfc, $correo, $telefono, $pass, $num){
        //consultas para la tabla de certificaciones internas
        $q1 = "INSERT INTO trabajadores (RFCT,NombreT,ApePT,ApeMT,CorreoT,TelT,ContraT)
        VALUES(:rfc, :nombre, :apat, :amat, :correo, :telefono, :pass)";
        $a1= [":rfc"=>$rfc, ":nombre"=>$nombre, ":apat"=>$apat, ":amat"=>$amat, ":correo"=>$correo, ":telefono"=>$telefono, ":pass"=>$pass];
        //acomoda todo en arreglos para mandarlos al CRUD
        $q2="INSERT INTO tratipousua (IdUsua,RFCT)
        VALUES (:num, :rfc)";
        $a2= [":num"=>$num,":rfc"=>$rfc];

        $querry = [$q1,$q2];
        $parametros = [$a1,$a2];           
        
        $this->base->insertar_eliminar_actualizar($querry, $parametros);
        
    }

    public function agregar_ceros($numero){
        $ceros = "";
        $numero_nuevo="";
        for ($i=0; $i < 6 ; $i++) { 
            $numero_nuevo = $ceros . $numero;
            if(strlen($numero_nuevo) == 6){
                break;
            }else{
                $ceros = $ceros . "0";
            }
        }
        return $numero_nuevo;
    }


    function id_individual(){
        $querry = "SELECT Max(IdPolInd) FROM polindividual ";
        $resultados = $this->base->mostrar($querry);
        return $resultados;

    }


    //retorna true si el id que recibe ya esta en la base y false si no
    function buscarPorRFC($rfc){
        $querry = "SELECT * FROM trabajadores
        WHERE RFCT = :rfc";
        
        
        $arre = [":rfc"=>$rfc];

        $resultados = $this->base->mostrar($querry, $arre);
        
        if($resultados != null){
            
            return true;
        }

        else{
            return false;
        }
    }
}

?>