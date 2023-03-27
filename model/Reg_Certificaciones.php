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
            $querry = "SELECT * FROM certinterna
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
            $querry = "SELECT * FROM certinterna";

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
        function buscarUltimoIdHist(){
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
        function insertar($idc, $logo, $desc, $nombre, $precioG, $precioA, $fecha, $idhg, $idha){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO certinterna (IdCerInt, LogoCerInt, DesCerInt, NomCertInt, EstatusCertInt)
            VALUES(:id, :logo, :descripcion, :nombre, :estatus)";

            $a1 = [":id"=>$idc, ":logo"=>$logo, ":nombre"=>$nombre, ":descripcion"=>$desc, "estatus"=>1];

            //consultas para la tabla de historicos
            $q2g = "INSERT INTO historico (Idh, FechaH, PrecioH)
            VALUES(:id, :fecha, :precio)";

            $a2g =[":id"=>$idhg, ":fecha"=>$fecha, ":precio"=>$precioG];

            $q2a = "INSERT INTO historico (Idh, FechaH, PrecioH)
                VALUES(:id, :fecha, :precio)";

            $a2a = [":id" => $idha, ":fecha" => $fecha, ":precio" => $precioA];

            //consultas para insertar en la tabla de relacion certh
            $q3g = "INSERT INTO certh (IdCerInt, IdH)
            VALUES(:idc, :idh)";

            $a3g = [":idc"=>$idc, ":idh"=>$idhg];

            $q3a = "INSERT INTO certh (IdCerInt, IdH)
                VALUES(:idc, :idh)";

            $a3a = [":idc" => $idc, ":idh" => $idha];

            //consultas para insertar registros en la relacion tipousuahis
            $q4g = "INSERT INTO tipousuahis (IdUsua, IdH) 
            VALUES(:idu, :idh)";

            $a4g = [":idu"=>5, ":idh"=>$idhg];

            $q4a = "INSERT INTO tipousuahis (IdUsua, IdH) 
                VALUES(:idu, :idh)";

            $a4a = [":idu" => 1, ":idh" => $idha];


            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1, $q2g, $q2a, $q3g, $q3a, $q4g, $q4a];
            $parametros = [$a1, $a2g, $a2a, $a3g, $a3a, $a4g, $a4a];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        
    }

?>