<?php
include('../../config/Crud_bd.php');

class EliminarCert{
    private $base;

    function instanciar(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    function cambiaeEtatus($idc){
        $querry = "UPDATE certinterna SET EstatusCertInt = :s WHERE IdCerInt = :idc";
        $array = [":s"=> 0, ":idc"=>$idc];

        $this->base->insertar_eliminar_actualizar($querry, $array);
    }
}
?>