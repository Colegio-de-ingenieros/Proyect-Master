<?php
    include('../../config/Crud_bd.php');

    class ModificarProyecto{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }
      

        //manda las consultas para insertar en las tablas de certificaciones internas e historicos
        function modificar($idp, $nombre, $inicio, $fin, $objetivo, $monto){
            //consultas para la tabla de certificaciones internas
            $querry = "UPDATE proyectos SET NomProyecto=:nombre, IniPro=:inicio, FinPro=:fin, ObjPro=:objetivo, MontoPro=:monto WHERE IdPro=:id";

            $arre = [":id"=>$idp, ":nombre"=>$nombre, ":inicio"=>$inicio, ":fin"=>$fin, ":objetivo"=>$objetivo,  ":monto"=>$monto];

            $this->base->insertar_eliminar_actualizar($querry, $arre);
        }
        
    }

?>