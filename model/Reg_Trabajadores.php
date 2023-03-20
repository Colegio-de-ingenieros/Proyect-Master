<?php
    include('../../config/Crud_bd.php');

    class NuevoTrabajador{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
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

        //manda las consultas para insertar en las tablas de certificaciones internas e historicos
        function insertar($nombre, $apat, $amat, $rfc, $correo, $telefono, $pass){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO trabajadores (RFCT,NombreT,ApePT,ApeMT,CorreoT,TelT,ContraT)
            VALUES(:rfc, :nombre, :apat, :amat, :correo, :telefono, :pass)";
            $a1= [":rfc"=>$rfc, ":nombre"=>$nombre, ":apat"=>$apat, ":amat"=>$amat, ":correo"=>$correo, ":telefono"=>$telefono, ":pass"=>$pass];
            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        
    }

?>