<?php
include('../../config/Crud_bd.php');

class EliminarProyecto{
    private $base;

    function instanciar(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //elimina el proyecto
    function eliminar($idp){
        $querry = "DELETE FROM proyectos WHERE IdPro=:idp";
        $arre = [":idp"=>$idp];


        $this->base->insertar_eliminar_actualizar($querry, $arre);
    } 

    function estatusPro($idp){
        $querry1 = "SELECT EstatusPro FROM proyectos WHERE IdPro=:idp";
        $arre1 = [":idp"=>$idp];
        $resultados = $this->base->mostrar($querry1, $arre1);
        return $resultados;
    }

    
}
?>