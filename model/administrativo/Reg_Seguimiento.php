<?php
    include('../../config/Crud_bd.php');

    class Seguimiento extends Crud_bd{
        public function buscar_cursos(){
            $this->conexion_bd();
            $sql = "SELECT claveCur, NomCur
                    FROM cursos
                    WHERE EstatusCur !=0";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_proyectos(){
            $this->conexion_bd();
            $sql = "SELECT idPro, NomProyecto
                    FROM proyectos
                    WHERE EstatusPro !=0";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certificaciones(){
            $this->conexion_bd();
            $sql = "SELECT idCerInt, NomCertInt 
                    FROM certinterna
                    WHERE EstatusCertInt !=0";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_instructores(){
            $this->conexion_bd();
            $sql = "SELECT ClaveIns, NomIns 
                    FROM instructor";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_socios(){
            $this->conexion_bd();
            $sql = "SELECT IdPerso, NomPerso 
                    FROM usuaperso";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresas(){
            $this->conexion_bd();
            $sql = "SELECT RFCUsuaEmp, NomUsuaEmp 
                    FROM usuaemp";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_participantes(){
            $lista=[];
            $instructores=$this->buscar_instructores();
            $socios=$this->buscar_socios();
            $empresas=$this->buscar_empresas();
            $lista[0]=$instructores;
            $lista[1]=$socios;
            $lista[2]=$empresas;
            return $lista;
        }

        public function id_seg(){
            $this->conexion_bd();
            $sql = "SELECT MAX(CAST(SUBSTRING(IdSeg, 1) AS INT)) FROM seguimiento";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $idSeg = $this->agregar_ceros($numero, 6);
        
            return $idSeg;
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

        public function insert_seg($idSeg){
            $this->conexion_bd();
            $q = "INSERT INTO seguimiento (IdSeg) VALUES(:idSeg)";

            $a = [":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_curso($idSeg, $claveCur){
            $this->conexion_bd();
            $q = "INSERT INTO segcursos (ClaveCur, IdSeg) VALUES(:claveCur, :idSeg)";

            $a = [":claveCur"=>$claveCur, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_proyectos($idSeg, $idPro){
            $this->conexion_bd();
            $q = "INSERT INTO segproyectos (IdPro, IdSeg) VALUES(:idPro, :idSeg)";

            $a = [":idPro"=>$idPro, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_certificaciones($idSeg, $idCer){
            $this->conexion_bd();
            $q = "INSERT INTO segcertint (IdSeg, IdCerInt) VALUES(:idSeg, :idCer)";

            $a = [":idSeg"=>$idSeg, ":idCer"=>$idCer,];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_instructores($idSeg, $claveIns){
            $this->conexion_bd();
            $q = "INSERT INTO seginstructor (ClaveIns, IdSeg) VALUES(:claveIns, :idSeg)";

            $a = [":claveIns"=>$claveIns, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_socios($idSeg, $idPerso){
            $this->conexion_bd();
            $q = "INSERT INTO segperso (IdPerso, IdSeg) VALUES(:idPerso, :idSeg)";

            $a = [":idPerso"=>$idPerso, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_empresas($idSeg, $rfc){
            $this->conexion_bd();
            $q = "INSERT INTO segusuaemp (RFCUsuaEmp, IdSeg) VALUES(:rfc, :idSeg)";

            $a = [":rfc"=>$rfc, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

    }

?>