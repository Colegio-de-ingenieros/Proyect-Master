<?php
    include('../../config/Crud_bd.php');

    class Tipo_Usuario extends Crud_bd{
        public function modificar_tipo_usua($id, $valor){
            $this->conexion_bd();
            $querry = "UPDATE persotipousua SET IdUsua=:valor
                        WHERE IdPerso=:id";
            $arre = [":id"=>$id, ":valor"=>$valor];
            $resultado = $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }  
    }

?>