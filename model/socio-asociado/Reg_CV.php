<?php
    include('../../config/Crud_bd.php');

    class funciones_cv{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function extraer_datos_usuario($id){
            $query = "SELECT usuaperso.NomPerso, 
                            usuaperso.ApePPerso, 
                            usuaperso.ApeMPerso, 
                            usuaperso.FechaNacPerso, 
                            usuaperso.TelMPerso, 
                            usuaperso.CallePerso, 
                            usuaperso.CorreoPerso, 
                            colonias.nomcolonia, 
                            municipios.nommunicipio, 
                            estados.nomestado 
                        FROM usuaperso, persolugares, colonias, municipios, estados 
                        WHERE usuaperso.IdPerso = :id 
                        and usuaperso.IdPerso = persolugares.IdPerso 
                        and persolugares.IdColonia = colonias.IdColonia 
                        and colonias.idmunicipio = municipios.idmunicipio 
                        and municipios.idestado = estados.idestado";
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