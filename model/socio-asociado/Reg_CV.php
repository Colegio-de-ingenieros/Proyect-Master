<?php
    include('../../config/Crud_bd.php');

    class funciones_cv{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function extraer_datos_usuario($id){
            $query = "SELECT NomPerso, ApePPerso, ApeMPerso, FechaNacPerso, CallePerso FROM `usuaperso` WHERE IdPerso = :id";
            $array = [":id"=>$id];
            $resultados = $this->base->mostrar($query, $array);

            if ($resultados != null){
                return $resultados;
            }
            else{
                return "No se encontraron resultados";
            }
        }
    }
?>