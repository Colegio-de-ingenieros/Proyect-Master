<?php
include('../../config/Crud_bd.php'); 

class dato{
    private $bd;

    function BD(){
        $this->bd = new Crud_bd();
        $this->bd->conexion_bd();
    }

    function usuario($tipo,$correo){
        if ($tipo == 'socio'){
            $consulta = "SELECT * FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;
       }

    }
}



?>