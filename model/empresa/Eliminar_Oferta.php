<?php
include('../../config/Crud_bd.php'); 

class EliminarOferta{
    private $base;

    function conexion(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    //hace la consulta principal de los datos de las certificaciones
    function eliminar($id){
        $q2 = "DELETE FROM bolsajornada WHERE IdEmpBol = :id"; 
        $a2= [":id"=>$id];
        $q3 = "DELETE FROM bolsacvlugares WHERE IdEmpBol = :id"; 
        $a3= [":id"=>$id];
        $q4 = "DELETE FROM bolsamodalidades WHERE IdEmpBol = :id"; 
        $a4= [":id"=>$id];
        $q5= "DELETE FROM bolsaempcv WHERE IdEmpBol = :id";
        $a5= [":id"=>$id];
        $q6= "DELETE FROM usuaempbolsa WHERE IdEmpBol = :id";
        $a6= [":id"=>$id];
        $q7= "DELETE FROM empboldias WHERE IdEmpBol = :id";
        $a7= [":id"=>$id];
        $q1 = "DELETE FROM bolsaempresa WHERE IdEmpBol = :id"; 
        $a1= [":id"=>$id];
        $querry = [$q2,$q3,$q4,$q5,$q6,$q7,$q1];
        $parametros = [$a2,$a3,$a4,$a5,$a6,$a7,$a1];

        $this->base->insertar_eliminar_actualizar($querry, $parametros);
    }
}

?>