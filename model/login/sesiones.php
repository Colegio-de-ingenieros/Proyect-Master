<?php

//validar que existe el usuario
require_once '../../config/Crud_bd.php';
class User extends Crud_bd {
  
    public function userExist_empresa($user){
        //si el usuario esta en la empresa
        //$password = password_hash($pass, PASSWORD_DEFAULT);
     

        $this->conexion_bd();
        $datos = $this->mostrar("SELECT 1 FROM usuaemp WHERE binary(CorreoUsuaEmp)= binary(:user)",['user'=>$user]);
        $this->cerrar_conexion();

        if(count($datos) == 0){
          
            return false;
        }else{
            
            return true;
        }
    
    }

    public function userExist_socio_asociado($user){
        //$md5pass = md5($pass);
        
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT 1 FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)",["user"=>$user]);
        $this->cerrar_conexion();

        if(count($datos) == 0){
            
            return false;
        }else{
            
            return true;
        }
    
    }
    public function userExist_trabajadores($user){
        //$md5pass = md5($pass);
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT 1 FROM trabajadores WHERE binary(CorreoT) =  binary(:user)",["user"=>$user]);
        $this->cerrar_conexion();

        if(count($datos) == 0){
            
            return false;
        }else{
            return true;
        }
    
    }

    public function isPasswordCorrect_empresa($user,$password)
    {
      
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT ContraUsuaEmp FROM usuaemp WHERE binary(CorreoUsuaEmp)= binary(:user) LIMIT 1",
                                ["user"=>$user]);
        $this->cerrar_conexion();

        
        if(password_verify($password,$datos[0][0])){

            return true;
        }else{
 
            return false;
        }
    
    }

    public function isPasswordCorrect_socio_asociado($user,$password)
    {
      
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT ContraPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)",
                                ["user"=>$user]);
        $this->cerrar_conexion();

        if(password_verify($password,$datos[0][0])){
   
            return true;
        }else{

            return false;
        }
    
    }
    public function isPasswordCorrect_trabajadores($user,$password)
    {
      
        $this->conexion_bd();
        $datos = $this->mostrar("SELECT ContraT FROM trabajadores WHERE binary(CorreoT) =  binary(:user) LIMIT 1",
                                ["user"=>$user]);
        $this->cerrar_conexion();

        
        if(password_verify($password,$datos[0][0])){
         
            return true;
        }else{
            
            return false;
        }
    
    }
   
}

?>