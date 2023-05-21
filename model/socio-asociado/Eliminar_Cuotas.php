<?php
include('../../config/Crud_bd.php');

class eliminarCuotas extends Crud_bd{

    public function eliminar($idV){
        $this->conexion_bd();
        $consulta1 = "DELETE FROM persovigcuota WHERE IdVigCuo=:idV";
        $parametros1 = [":idV"=>$idV];

        $consulta2 = "DELETE FROM tipovigcuota WHERE IdVigCuo=:idV";
        $parametros2 = [":idV"=>$idV];

        $consulta = "DELETE FROM vigenciacuotas WHERE IdVigCuo=:idV";
        $parametros = [":idV"=>$idV];

        $consul=[$consulta1, $consulta2,$consulta];
        $para=[$parametros1, $parametros, $parametros2];

        $datos = $this->insertar_eliminar_actualizar($consul,$para);
        $this->cerrar_conexion();
        return $datos;
    }

    
}
?>