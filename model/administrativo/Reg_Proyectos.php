<?php
    include('../../config/Crud_bd.php');

    class NuevoProyecto{
        private $base;

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


        public function buscarUltimoIdPro(){
            $sql = "SELECT MAX(CAST(SUBSTRING(IdPro, 1) AS INT)) FROM proyectos";
            $arreglo = $this->base->mostrar($sql);

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $auxIdPro = $this->agregar_ceros($numero, 6);
            
            return $auxIdPro;
        }

        public function agregar_ceros($numero, $lon){
            $ceros = "";
            $numero_nuevo="";
            for ($i=0; $i < $lon ; $i++) { 
                $numero_nuevo = $ceros . $numero;
                if(strlen($numero_nuevo) == $lon){
                    break;
                }else{
                    $ceros = $ceros . "0";
                }
            }
            return $numero_nuevo;
        }

        //manda las consultas para insertar en las tablas de certificaciones internas e historicos
        function insertar($idp, $nombre, $inicio, $fin, $objetivo, $monto){
            //consultas para la tabla de certificaciones internas
            $q1 = "INSERT INTO proyectos (IdPro, NomProyecto, IniPro, FinPro, ObjPro, MontoPro,EstatusPro)
            VALUES(:id, :nombre, :inicio, :fin,:objetivo, :monto, :estatus)";

            $a1 = [":id"=>$idp, ":nombre"=>$nombre, ":inicio"=>$inicio, ":fin"=>$fin, ":objetivo"=>$objetivo,  ":monto"=>$monto,  "estatus"=>1];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        
    }

?>