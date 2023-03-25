<?php
include('../../config/Crud_bd.php'); 

class EliminarTrabajadores{
    private $base;

    function conexion(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    //hace la consulta principal de los datos de las certificaciones
    function eliminar($rfc){
        $q2 = "DELETE FROM tratipousua WHERE RFCT = :rfc"; 
        $a2= [":rfc"=>$rfc];
        $q1 = "DELETE FROM Trabajadores WHERE RFCT = :rfc"; 
        $a1= [":rfc"=>$rfc];
        $querry = [$q2,$q1];
        $parametros = [$a2,$a1];

        $this->base->insertar_eliminar_actualizar($querry, $parametros);
    }
}

?>