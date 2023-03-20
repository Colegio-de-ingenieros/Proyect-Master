<?php
    include('../../config/Crud_bd.php');

    class NuevoProyecto{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        //retorna true si el id que recibe ya esta en la base y false si no
        function buscarPorId($id){
            $querry = "SELECT * FROM proyectos WHERE IdPro = :id";

            $arre = [":id"=>$id];

            $resultados = $this->base->mostrar($querry, $arre);

            if($resultados != null){
                return true;
            }

            else{
                return false;
            }
        }

        //busca el ultimo id de la tabla proyectos
        function buscarUltimoIdPro(){
            $querry = "SELECT * FROM proyectos";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for($i=0; $i<count($resultados);$i++){
                array_push($aux, floatval($resultados[$i]["IdPro"]));
            }

            sort($aux, 0);

            $id = 0;

            if(count($aux)>= 1){
                $id = $aux[count($aux) - 1];
            }

            return $id;
        }

        
        //manda las consultas para insertar en la tabla proyectos
        function insertar($idP, $nombreP, $iniP, $finP, $objP, $montoP){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO proyectos (IdPro, NomProyecto, IniPro, FinPro, ObjPro, MontoPro, EstatusPro)
            VALUES(:id, :nombreP, :iniP, :finP, :objp, :montoP,:estatusP)";

            $a1 = [":id"=>$idP, ":nombre"=>$nombreP, ":iniP"=>$iniP, ":finP"=>$finP,":objP"=>$objP, ":montoP"=>$montoP,   "estatusP"=>1];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function generarID(){
            $idp = buscarUltimoIdPro();
            $id = floatval($idp) +1; 
            $idp = strval($id);
            for($i=strlen($idp); $i<6; $i++){
                $idp = '0'.$idp;
            }
            return $idp;
        }
        
    }

?>