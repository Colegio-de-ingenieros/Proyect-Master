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
        public function existeCorreo($correo)
    {
        # ve si el correo ya esta en la base
        $dato1 = $this->mostrar("SELECT CorreoPerso FROM usuaperso WHERE binary(CorreoPerso)= binary(:correo)",[':correo'=>$correo]);
        $dato2 = $this->mostrar("SELECT CorreoUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp)= binary(:correo)",[':correo'=>$correo]);
        $dato3 = $this->mostrar("SELECT CorreoT FROM trabajadores WHERE binary(CorreoT)= binary(:correo)",[':correo'=>$correo]);

        if(count($dato1) == 0 && count($dato2) == 0 && count($dato3) == 0){
          
            return false;
        }else{
            
            return true;
        }
    }
        
    }

?>