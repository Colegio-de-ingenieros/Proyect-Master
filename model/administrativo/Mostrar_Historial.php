<?php
include('../../config/Crud_bd.php');
    
    class Historial{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function historialAsoc($idc){
            $querry = "SELECT * FROM certh, historico, tipousuahis WHERE (certh.IdCerInt = :idc 
            AND certh.IdH = historico.IdH AND historico.IdH = tipousuahis.IdH AND tipousuahis.IdUsua = 1) 
            ORDER BY FechaH;";

            $resultados = $this->base->mostrar($querry, [":idc" => $idc]);

            return $resultados;
        }

        function historialGen($idc)
        {
            $querry = "SELECT * FROM certh, historico, tipousuahis WHERE (certh.IdCerInt = :idc 
                AND certh.IdH = historico.IdH AND historico.IdH = tipousuahis.IdH AND tipousuahis.IdUsua = 5) 
                ORDER BY FechaH;";

            $resultados = $this->base->mostrar($querry, [":idc" => $idc]);

            return $resultados;
        }

        //hace la consulta principal de los datos de la certificacion con el id que recibe
        function getCertificacionesId($idc)
        {
            $querry = "SELECT * FROM certinterna WHERE IdCerInt = :idc";
            $arre = [":idc" => $idc];
            $resultados = $this->base->mostrar($querry, $arre);

            return $resultados;
        }
    }
?>