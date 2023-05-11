<?php
include('../../config/Crud_bd.php');

class eliminarCursos extends Crud_bd{

    public function eliminar($idc){
        $this->conexion_bd();
        $consulta1 = "DELETE FROM persoaltacur WHERE IdCurPerso=:idc";
        $parametros1 = [":idc"=>$idc];

        $consulta = "DELETE FROM altacursos WHERE IdCurPerso=:idc";
        $parametros = [":idc"=>$idc];

        $consul=[$consulta1, $consulta];
        $para=[$parametros1, $parametros];

        $datos = $this->insertar_eliminar_actualizar($consul,$para);
        $this->cerrar_conexion();
        return $datos;
    }

    
}
?>