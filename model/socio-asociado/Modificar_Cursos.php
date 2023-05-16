<?php
    include('../../config/Crud_bd.php');

    class modificarCursos extends Crud_bd{

        public function actualizar($idc, $nombre, $hra, $doc, $org){
            $this->conexion_bd();
            
            $consulta = "UPDATE altacursos SET NomCurPerso=:nombre, HraCurPerso=:hra, DocCurPerso=:doc, OrgCurPerso=:org WHERE IdCurPerso=:idc";
            $parametros = [":idc"=>$idc, ":nombre"=>$nombre, ":hra"=>$hra, ":doc"=>$doc, ":org"=>$org];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }
    }
?>