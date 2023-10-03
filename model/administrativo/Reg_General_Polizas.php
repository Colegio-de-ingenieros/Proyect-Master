<?php
    include('../../config/Crud_bd.php');

    class NuevaPoliza{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        
        function buscarPorId($id){
            $querry = "SELECT * FROM  polgeneral WHERE IdPolGral = :id";
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
            $sql = "SELECT MAX(CAST(SUBSTRING(IdPolGral, 1) AS INT)) FROM polgeneral";
            $arreglo = $this->base->mostrar($sql);

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $auxIdPro = $this->agregar_ceros($numero, 4);
            
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

        
        function insertar($idp, $nombre, $apeP, $apeM, $concepto, $fecha,$tipo,$servicio){
           //Inserta en la tabla polgeneral
            $q1 = "INSERT INTO polgeneral (IdPolGral, NomElaPol, ApePElaPol, ApeMElaPol, ConceptoGral, FechaGral)
            VALUES(:id, :nombre, :apeP, :apeM,:concepto, :fecha)";
            $a1 = [":id"=>$idp, ":nombre"=>$nombre, ":apeP"=>$apeP, ":apeM"=>$apeM, ":concepto"=>$concepto,  ":fecha"=>$fecha];
            //Inserta en la tabla tipogralpol
            $q2 = "INSERT INTO tipogralpol (IdPolGral, IdTipoPol)  VALUES(:id, :tipo)";
            $a2 = [":id"=>$idp, ":tipo"=>$tipo];
            //Inserta en la tabla sergralpol
            $q3 = "INSERT INTO sergralpol (IdPolGral, IdSerPol)  VALUES(:id, :servicio)";
            $a3 = [":id"=>$idp, ":servicio"=>$servicio];

            //acomoda todo en arreglos para mandarlos al CRUD
            $querry = [$q1, $q2,$q3];
            $parametros = [$a1,$a2, $a3];
            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertaCurso($idp, $curso){
            //Inserta en la tabla cursoserpol
             $q1 = "INSERT INTO cursoserpol (IdSerPol, ClaveCur) VALUES(:id, :curso)";
             $a1 = [":id"=>$idp, ":curso"=>$curso];

             $this->base->insertar_eliminar_actualizar($q1, $a1);
         }

         function insertaCertificacion($idp, $certificacion){
            //Inserta en la tabla cserserpol
             $q1 = "INSERT INTO cerserpol (IdSerPol, IdCerInt) VALUES(:id, :certificacion)";
             $a1 = [":id"=>$idp, ":certificacion"=>$certificacion];

             $this->base->insertar_eliminar_actualizar($q1, $a1);
         }

         function insertaUsuaPerso($idp, $perso){
            //Inserta en la tabla persogralpol
             $q1 = "INSERT INTO persogralpol (IdPolGral, IdPerso) VALUES(:id, :perso)";
             $a1 = [":id"=>$idp, ":perso"=>$perso];

             $this->base->insertar_eliminar_actualizar($q1, $a1);
         }

         function insertaUsuaEmp($idp, $empresa){
            //Inserta en la tabla empgralpol
             $q1 = "INSERT INTO empgralpol (IdPolGral, RFCUsuaEmp) VALUES(:id, :empresa)";
             $a1 = [":id"=>$idp, ":empresa"=>$empresa];

             $this->base->insertar_eliminar_actualizar($q1, $a1);
         }


        
    }

?>