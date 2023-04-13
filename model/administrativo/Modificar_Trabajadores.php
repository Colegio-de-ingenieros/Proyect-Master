<?php
    include('../../config/Crud_bd.php');
    class ModTrabajador{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }
        function modificar($rfc,$nombre,$ap,$am,$correo,$telefono){
            $q1="UPDATE trabajadores SET NombreT = :nombre, ApePT = :ap, ApeMT = :am, CorreoT = :correo, TelT = :telefono WHERE RFCT = :rfc";
            $a1 = [":nombre"=>$nombre, ":ap"=>$ap, ":am"=>$am, ":correo"=>$correo, ":telefono"=>$telefono, ":rfc"=>$rfc];
            $querry = [$q1];
            $arre = [$a1];
            $this->base->insertar_eliminar_actualizar($querry, $arre);
        }
    }