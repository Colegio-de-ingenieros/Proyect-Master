<?php
    include('../../config/Crud_bd.php');

    class NuevaCertificacion{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        //retorna true si el id que recibe ya esta en la base y false si no
        function buscarPorId($id){
            $querry = "SELECT * FROM certInterna
            WHERE IdCerInt = :id";

            $arre = [":id"=>$id];

            $resultados = $this->base->mostrar($querry, $arre);

            if($resultados != null){
                return true;
            }

            else{
                return false;
            }
        }

        //busca el ultimo id de la tabla certificaciones internas
        function buscarUltimoIdCert(){
            $querry = "SELECT * FROM certInterna";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for($i=0; $i<count($resultados);$i++){
                array_push($aux, floatval($resultados[$i]["IdCerInt"]));
            }

            sort($aux, 0);

            $id = 0;

            if(count($aux)>= 1){
                $id = $aux[count($aux) - 1];
            }

            return $id;
        }

        //busca el ultimo id de la tabla certificaciones internas
        function buscarUltimoIdHist()
        {
            $querry = "SELECT * FROM historico";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for ($i = 0; $i < count($resultados); $i++) {
                array_push($aux, floatval($resultados[$i]["IdH"]));
            }

            sort($aux, 0);

            $id = 0;
            if(count($resultados) >= 1){
                $id = $aux[count($aux) - 1];
            }
           

            return $id;
        }

        //manda las consultas para insertar en las tablas de certificaciones internas e historicos
        function insertar($idc, $logo, $desc, $nombre, $precio, $fecha, $idh){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO certinterna (IdCerInt, LogoCerInt, DesCerInt, NomCertInt, EstatusCertInt)
            VALUES(:id, :logo, :descripcion, :nombre, :estatus)";

            $a1 = [":id"=>$idc, ":logo"=>$logo, ":nombre"=>$nombre, ":descripcion"=>$desc, "estatus"=>1];

            //consulta para la tabla de historicos
            $q2 = "INSERT INTO historico (Idh, FechaH, PrecioH)
            VALUES(:id, :fecha, :precio)";

            $a2 =[":id"=>$idh, ":fecha"=>$fecha, ":precio"=>$precio];

            //consulta para insertar en la tabla de relacion certh
            $q3 = "INSERT INTO certh (IdCerInt, IdH)
            VALUES(:idc, :idh)";

            $a3 = [":idc"=>$idc, ":idh"=>$idh];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1, $q2, $q3];
            $parametros = [$a1, $a2, $a3];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        
    }

?>